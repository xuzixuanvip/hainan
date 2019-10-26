<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskProcess;
use App\Models\TaskComment;
use App\Models\Depart;
use App\Models\Category;
use App\Repos\TaskRepo;
use App\Services\Wechat;
use App\Exports\TaskExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $where = $param = [];
        $query = Task::query();
        $page = $request->page? :1;
        $num  = 20;
        $start = $page>1?(($page-1)*$num+1):1;
        //dd($page);
        if($request->status) {
            $param['status'] = $where['status'] = (int)$request->status;
        }

        
        if($request->worker_id){
            $param['status'] = $where['worker_id'] = $request->worker_id;
        }

        if($request->depart_id){
            $param['depart_id'] = $where['depart_id'] = $request->depart_id;

        }

        if($request->category_id){
            $param['category_id'] = $where['category_id'] = $request->category_id;

        }

        if(session('admin')->role_id!=999) {
             $where['depart_id'] = session('admin')->depart_id;
        }
        $query->where($where);

        if ($request->keyword) {
            $keyword = trim($request->keyword);
            $query->where(function($query) use ($keyword) {
                $query->where('mobile','like','%'.$keyword.'%')
                      ->orWhere('customer_name','like','%'.$keyword.'%')
                      ->orWhere('content','like','%'.$keyword.'%')
                      ->orWhere('remark','like','%'.$keyword.'%');
            });
        }

        if($request->money==1) {
            $query->where('money','>',0);
            $param['money'] = $request->money;
        }

        if($request->beginDate) {
            $begin = $request->beginDate.' 0:0:0';
            $end   = $request->endDate.' 23:59:59';
            $param['beginDate'] = $request->beginDate;
            $param['endDate']   = $request->endDate;

            $query->whereBetween('created_at', [$begin,$end]);
            
        }
        $departs = Depart::get();
        $cates   = Category::get();
        $workers = User::where('role_id',1)->get();
    	$list = $query->orderBy('created_at','desc')->paginate(20);

        if($request->price) {
           $list = Task::where('money','>',0)->orderBy('created_at','desc')->paginate($num);
           $param['price'] = 1; 
        }
    	return view('admin.task.index',compact('list','param','workers','departs','cates','start'));
    }

    public function show($id)
    {
    	$data = Task::find($id);
        $wechatInfo = json_decode($data->userinfo,true);
        $process = TaskProcess::where('task_id',$id)->get();
        $comment = TaskComment::where('task_id',$id)->first();
    	return view('admin.task.show',compact('wechatInfo','data','process','comment'));
    }

     public function edit($id)
    {
        $data = Task::find($id);
        $wechatInfo = json_decode($data->userinfo,true);
        $process = TaskProcess::where('task_id',$id)->get();
        $comment = TaskComment::where('task_id',$id)->first();
        $departs = Depart::get();
        $cates = Category::get();
        $workers = User::where('role_id',1)->get();
        return view('admin.task.edit',compact('data','departs','cates','wechatInfo','process','comment','workers'));
    }

    public function print($id)
    {
        $data = Task::find($id);
       
        $process = TaskProcess::where('task_id',$id)->get();
        $comment = TaskComment::where('task_id',$id)->first();
        return view('admin.task.print',compact('data','process','comment'));
    }

    

    

    public function add()
    {
        $platforms = Platform::select('id','name')->get();
        $sellers   = Seller::select('id','truename')->get();
        return view('admin.task.add',compact('platforms','sellers'));
    }

    public function save(TaskRequest $request)
    {
        $rs['status'] = 'danger';
        $seller_id    = $request->seller_id;
        $seller       = Seller::find($seller_id);
       
        $data     = $request->except('_token');
        $platform = Platform::find($data['platform_id']);
        //dd($data['platform_id']);
        // 如果任务数乘以任务金额+任务数*佣金+平台抽成>卖家余额 那么不能发任务
        $totalMoney    = ($data['price']+$data['commission'])*$data['num'];

       

        DB::beginTransaction();
        try{
           $data['is_admin'] = 1;
           $flag = Task::create($data);       
            
            if(!$flag) {
                DB::rollBack();
                $rs['msg'] = '添加任务失败';
                return back()->with($rs);
            } 
        } catch(\Exception $e) {
            DB::rollBack();
            $rs['msg'] = $e->getMessage();
            return back()->withInput()->with('rs',$rs);
        }
        
        DB::commit();
        $rs['status'] = 'success';
        $rs['msg']    = '任务发布成功';
        return redirect('zadmin/task/')->withInput()->with('rs',$rs);
    }

    
    public function del($user_id)
    {
        $rs['status'] = 'warning';
        if(session('admin')->role_id!=999) {
            $rs['msg']    = '没有操作权限';
            return back()->with('rs',$rs);
        }
        $flag = Task::destroy($user_id);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '删除成功';
            return redirect('zadmin/task/')->withInput()->with('rs',$rs);
        }
    }

   

    public function update(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg']    = '操作失败';
        $data = $request->except(['_token']);
        $flag = Task::where(['id'=>$request->id])->update($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return back()->with('rs',$rs);
        } 
        return back()->withInput()->with('rs',$rs);
        
    }

    /**
    * 后台操作订单完成
    */
   public function complete(Request $request)
   {
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        $task   = Task::find($request->task_id);
        $task->status = 100;
        $flag = $task->save();

        $worker =  User::find(object_get($task,'worker_id'));

        // 推送消息
        $msg      = $task->toArray();
        $msg['first']       = '您的报修已完成';       
        $msg['address']     = object_get($task,'depart.name');
        $msg['cate_name']   = object_get($task,'category.name');
        $msg['worker_name'] = object_get($worker,'truename',''); 
        $msg['content']     = $task->remark;      
        $msg['remark']    ='工单已经处理完成,点击查看详情。'; 
        $msg['url']       = config('app.url').'/user/task/show/'.$task->id;

        Wechat::sendMsgTpl('complete',$msg);  // 先推送给客户
        
        // 再推送给管理员
        $uWhere['role_id']   = 100;
        $uWhere['depart_id'] = $task->depart_id;
        $managers = User::where($uWhere)->get();
        foreach ($managers as $k => $v) {
            if(empty($v->openid)) continue; 
            $msg2 = $msg;
            $msg2['first'] = '工单已完成';            
            $msg2['openid'] = $v->openid;
            Wechat::sendMsgTpl('complete',$msg2);
        }

        // 超级管理员
        $admins = User::where(['role_id'=>999])->get();
        foreach ($admins as $k => $v) {
            if(empty($v->openid)) continue; 
            $msg2 = $msg;
            $msg2['first'] = '工单已完成';            
            $msg2['openid'] = $v->openid;
            Wechat::sendMsgTpl('complete',$msg2);
        }


        if($flag) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return redirect('zadmin/task')->with('rs',$rs);
        }
        return redirect('zadmin/task')->with('rs',$rs);

   }

    //导出工单。
    public function taskExport(Request $request)
    {
        $param = $request->all();
       
        if(session('admin')->role_id!=999) {
             $param['depart_id'] = session('admin')->depart_id;
        }
        return Excel::download(new TaskExport($param), '工单统计.xlsx');   
    }
}
