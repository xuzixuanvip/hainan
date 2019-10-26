<?php

namespace App\Http\Controllers\TaskApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\TaskReply;
use App\Models\User;
use App\Models\TaskProcess;
use App\Models\TaskComment;
use App\Models\TaskService;
use App\Models\Service;
use App\Models\Notice;
use App\Repos\TaskRepo;
use App\Repos\DepartRepo;
use Session;
use DB,Log;
use App\Services\Wechat;
use App\Services\Msgtpl;
use Image;

class TaskController extends Controller
{
    public function index( Request $request)
    {
        $wechat_user =  session('wechat.oauth_user.default');
        $where = $param = [];

        $query = Task::query();
        $openid = $wechat_user->id;
        //dd($openid);
        $user  = User::where('openid',$openid)->first();

        if(object_get($user,'role_id')!= '999') {
            // 如果是维修工
            if(object_get($user,'role_id')==1 ) {
                $query->where(['worker_id' => $user->id])
                      ->orWhere(['openid'=>$openid]);
            } elseif (object_get($user,'role_id')==100) {
                $query->where(['depart_id' => $user->depart_id])
                      ->orWhere(['openid'=>$openid]);;
            } else {
                $query->where(['openid' => $openid]);
            }       
        }
             
        
        if ($request->status) {
            $where['status'] = intval($request->status);
        }

        
    	$query = $query->where($where);
        if($request->keyword) {
            $query = $query->where('title','like','%'.$request->keyword.'%');
        }

        $list = $query->orderBy('created_at','desc')
                    ->paginate(5);
        $status = $this->taskStatus();

                          
        return view('hrs.task.index',compact('list','status','param'));
        
    }

    public function create()
    {
        if (object_get(session('user'),'role_id') != self::EMPLOYEE) {
            //echo '此功能暂不管理员开放';die;
        }

        $wechat_user    =  session('wechat.oauth_user.default');
        // 根据openid获取用户信息
        $customer = Task::where(['openid'=>$wechat_user->id])
                        ->orderBy('id','desc')
                        ->first();

        $cates   = Category::select('id','name')->get();
        $departs = DepartRepo::get(['pid'=>0]);
        $notice1 = Notice::find(1);
        $notice2 = Notice::find(2);
        
        $serviceTimes = $this->serviceTime();
        return view('hrs.task.add',compact('cates','serviceTimes','customer','departs','notice1','notice2'));
    } 

   

    public function save(Request $request)
    {
        //dd($request->all());
    	$rs['status'] = 'danger';      
        $data         = $request->except(['_token','thumb','address','address2']);    

        DB::beginTransaction();
        try{
           $wechat_user    =  session('wechat.oauth_user.default');
           
           $data['userinfo'] = json_encode(Wechat::getUserInfo($wechat_user->id));
           $data['openid'] = $wechat_user->id;
           $code = date('Ymdhis').str_random(3);
           try {
               if ($request->hasFile('thumb')) {
                  
                    $extension = $request->thumb->extension();
                    $filename = $code.'.'.$extension;
                    $request->thumb->storeAs('public/images',$filename);

                    $img = Image::make($request->thumb);
                    $img->resize(320, 240);
                    $img->save('thumb/t_'.$filename);

                    $data['pic']   = '/storage/images/'.$filename; 
                    $data['thumb'] = '/thumb/t_'.$filename; 
               } 

               if ($request->hasFile('video')) {
                    $extension = $request->video->extension();
                    $filename = $code.'.'.$extension;
                    $request->video->storeAs('public/video',$filename);
                    $data['video']  = '/storage/video/'.$filename; 
               } 
               
           } catch (\Exception $e) {
               Log::info('上传文件失败:'.$e->getMessage());
           }
           
           
           $data['service_time'] = $request->service_time1.' '.$request->service_time2;  
           $data['status']   =1 ;
           $data['code']     = $code;
           $data['address'] = $request->address.' '.$request->address2;

           $flag = Task::create($data);

            
            if(!$flag) {
                DB::rollBack();
                return back()->with($rs);
            } 
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            $rs['msg'] = $e->getMessage();
            return back()->withInput()->with('rs',$rs);
        }
    	
        
        $rs['status'] = 'success';
        $rs['msg']    = '工单提交成功';

        try {
           // 推送消息
            $data = $flag->toArray();
            TaskRepo::newTaskPush($data);
        } catch (\Exception $e) {
            $rs['msg']    = $e->getMessage();
        }
        
        //return response()->json($rs);
       return redirect('user/task')->with('rs',$rs);    
       // return back()->withInput()->with('rs',$rs);

    }

    public function edit($id)
    {
        $data    = Task::find($id);
        $cates   = Category::select('id','name')->get();
        $departs = DepartRepo::get(['pid'=>0]);
        
        $serviceTimes = $this->serviceTime();  
            
        return view('hrs.task.edit',compact('data','cates','departs','serviceTimes'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $rs['status'] = 'danger';      
        $data         = $request->except(['_token','thumb','address','address2']);    

        DB::beginTransaction();
        try{
           $wechat_user    =  session('wechat.oauth_user.default');
           
           $data['userinfo'] = json_encode(Wechat::getUserInfo($wechat_user->id));
           $data['openid'] = $wechat_user->id;
           $code = date('Ymdhis').str_random(3);
           try {
               if ($request->hasFile('thumb')) {
                  
                    $extension = $request->thumb->extension();
                    $filename = $code.'.'.$extension;
                    $request->thumb->storeAs('public/images',$filename);

                    $img = Image::make($request->thumb);
                    $img->resize(320, 240);
                    $img->save('thumb/t_'.$filename);

                    $data['pic']   = '/storage/images/'.$filename; 
                    $data['thumb'] = '/thumb/t_'.$filename; 
               } 

               if ($request->hasFile('video')) {
                    $extension = $request->video->extension();
                    $filename = $code.'.'.$extension;
                    $request->video->storeAs('public/video',$filename);
                    $data['video']  = '/storage/video/'.$filename; 
               } 
               
           } catch (\Exception $e) {
               Log::info('上传文件失败:'.$e->getMessage());
           }
           
           
           $data['service_time'] = $request->service_time1.' '.$request->service_time2;  
           $data['status']   =1 ;
           $data['code']     = $code;
           $data['address'] = $request->address.' '.$request->address2;
           $id = array_pull($data,'id');
           $flag = Task::where(['id'=>$id])->update($data);

            
            if(!$flag) {
                DB::rollBack();
                return back()->with($rs);
            } 
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            $rs['msg'] = $e->getMessage();
            return back()->withInput()->with('rs',$rs);
        }
        
        
        $rs['status'] = 'success';
        $rs['msg']    = '工单提交成功';      
      
        return redirect('user/task')->with('rs',$rs);    
       

    }

  


    public function show($id)
    {
        $data = Task::withTrashed()->find($id);
        $comment = TaskComment::where('task_id',$id)->first();
        $workers = User::where('role_id',1)->get();
        $wechat_user =  session('wechat.oauth_user.default');
        $user = User::where('openid',$wechat_user->id)->first();
        $process = TaskProcess::where(['task_id'=>$id])->get();
        $user_openid = $wechat_user->id;
        $point_arr = $this->commentPoint();
        $services = Service::get();
        return view('hrs.task.show',compact('data','workers','user','comment','point_arr','services','user_openid','process'));
    }   

    public function process(Request $request)
    {
        
        $rs['status'] = 'danger';
        $rs['msg']    = '操作成功';       
        $flag = TaskRepo::dispatch($request);
        if($flag == true) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        } 
        return back()->with('rs',$rs);
        
    }

    // 报价信息
    public function processPrice(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg']    = '操作失败';
        $data = $request->except(['_token']);
        $wechat_user =  session('wechat.oauth_user.default');
        $data['worker_openid'] = $wechat_user->id;
        $data['status'] = 0;      

        $flag = TaskService::create($data);
        $task = Task::find($data['task_id']);
        $task->status = 75;
        $task->money = $data['service_price'];
        $task->save();
        
        $process = array_only($data,['task_id','worker_openid','status']);
        $user = User::where('openid',$wechat_user->id)->first();
        $process['worker_id']      = $user->id;
        $process['creater_openid'] = $wechat_user->id;
        $process['remark'] = '报价：'.$data['service_name'].','.$data['service_price'];
        $process['money'] = $data['service_price'];
        $process['status'] = 75;
        TaskProcess::create($process);
        $msg = $data;
        $msg['first'] = '工单报价';
        $msg['openid']        =  $task->openid;
        $msg['customer_name'] = $task->customer_name;
     
        $msg['remark'] = $process['remark'];
        $msg['url']    = config('app.url').'/user/task/price-detail/'.$flag->id;
        Wechat::sendMsgTpl('price_to_user',$msg);  // 推送报价给客户

        if($flag) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }

    /**
     * 工单报价详情
     */
    public function priceDetail($id)
    {
        $price = TaskService::find($id);
        $task = Task::find($price->task_id);
        return view('hrs.task.price',compact('price','task'));
    }

    /**
     * 用户确认工单费用
     */
    public function priceConfirmed(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        $taskService = TaskService::find($request->task_service_id);
        $taskService->status = $request->status;
        $flag = $taskService->save();

        if($request->status == -1) {
            Task::where('id',$taskService->task_id)->update(['status'=>'-1']);
            $where['task_id'] = $taskService->task_id;
            $where['worker_openid'] = $taskService->worker_openid;
            $process = TaskProcess::where($where)->first()->toArray();
            $process['status'] = '-1';
            $process['remark'] = '用户拒绝付款';
            $process['creater_openid'] = $taskService->task_openid;
            TaskProcess::create($process);
        }

        if($flag == true) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return redirect('user/task/show/'.$taskService->task_id)->with('rs',$rs);
        } 
        return redirect('user/task/show/'.$taskService->task_id)->with('rs',$rs);
    }

    /**
     * 完工
     */
    public function processComplete(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg']    = '操作失败';
        $thumbs = $pics = '';
        try{
            if($request->has('work_pic')) {
                $file = $request->work_pic;
                $code = date('Ymdhis').str_random(3);   
                $ext  = $file->extension();
                $filename = $code.'.'.$ext;
                $file->storeAs('public/images',$filename);
                $pics   .= '/storage/images/'.$filename.','; 

                $img = Image::make($file);
                $img->resize(320, 240);
                $img->save('thumb/t_'.$filename);           
                $thumbs .= '/thumb/t_'.$filename.',';
                
            }         
        } catch (\Exception $e) {
            Log::info('完工图片上传失败: '.$e->getMessage());
        }
          

        $wechat_user =  session('wechat.oauth_user.default');    
        $taskProcess = TaskProcess::where('task_id',$request->task_id)->first();
        if($taskProcess) {
            $taskProcess = $taskProcess->toArray();
            $taskProcess = array_except($taskProcess,['created_at','updated_at']);
            $taskProcess['work_pic']   = $pics;
            $taskProcess['work_thumb'] = $thumbs;             
            $taskProcess['status'] = 100; 
            $taskProcess['remark'] = $request->remark; 
            $taskProcess['creater_openid'] = $wechat_user->id;           
            $flag = TaskProcess::create($taskProcess);
        }       

        $task   = Task::find($request->task_id);
        $task->status = 100;
        $task->end_time   = date('Y-m-d H:i:s');
        $task->end_result = $request->remark;
        $flag = $task->save();        
        $worker = User::find(array_get($taskProcess,'worker_id'));

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

        if($flag == true) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        } 
        return back()->with('rs',$rs);
        
    }


    public function comment(Request $request)
    {
        $point_arr = $this->commentPoint();
        $rs['status'] = 'danger';
        $rs['msg']    = '操作失败';
        $data = $request->except(['_token']);
        $wechat_user =  session('wechat.oauth_user.default');  
        $data['user_openid'] = $wechat_user->id;
        $task = Task::find($request->task_id);
        $taskProcess = TaskProcess::where(['task_id'=>$request->task_id])
        ->orderBy('id','desc')
        ->first();

        // 如果是零分那么要打回给维修人员
        if($taskProcess && $data['point']==0) {
            //dd($request->task_id);
            
            $task->status = 50;
            $ret = $task->save();
            //dd($ret);
           
            $taskProcess->status = 50;
            $taskProcess->save();
            

             // 推送给 维修工
            $msg['url']    = config('app.url').'/user/task/show/'.$task->id;
            $msg['openid'] = $taskProcess->worker_openid;
            $msg['name'] = object_get($task,'category.name');
            $msg['result'] = $data['point'].'分，'.$point_arr[$data['point']];
            Wechat::sendMsgTpl('comment',$msg);  // 
            // 推送给管理员
            $uWhere['role_id']   = 100;
            $uWhere['depart_id'] = $task->depart_id;
            $managers = User::where($uWhere)->get();
            foreach ($managers as $k => $v) {
                if(empty($v->openid)) continue; 
                $msg2 = $msg;                         
                $msg2['openid'] = $v->openid;
                Wechat::sendMsgTpl('comment',$msg2);
            }

            if($ret) {
                $rs['status'] = 'success';
                $rs['msg'] = '操作成功';
                return back()->with('rs',$rs);
            } 

            $data['worker_id'] = $taskProcess->worker_id;
        }


        
        $data['remark'] = $point_arr[$data['point']];

        $flag = TaskComment::create($data);

        
        if($flag) {

            // 推送给 维修工
            $msg['openid'] = $taskProcess->worker_openid;
            $msg['name']   = object_get($task,'category.name');
            $msg['result'] = $data['point'].'分，'.$point_arr[$data['point']];
            $msg['url']       = config('app.url').'/user/task/show/'.$task->id;
            Wechat::sendMsgTpl('comment',$msg);  // 
            // 推送给管理员
            $uWhere['role_id']   = 100;
            $uWhere['depart_id'] = $task->depart_id;
            $managers = User::where($uWhere)->get();
            foreach ($managers as $k => $v) {
                if(empty($v->openid)) continue; 
                $msg2 = $msg;                         
                $msg2['openid'] = $v->openid;
                Wechat::sendMsgTpl('comment',$msg2);
            }


            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        } 

        
        return back()->with('rs',$rs);
    }

     /**
     * 退单
     */
    public function refund(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        $data = $request->all();
       // dd($data);
        $wechat_user =  session('wechat.oauth_user.default'); 
        $user = User::where('openid',$wechat_user->id)->first();
        $data['username'] = $user->username."($user->truenmae)";
        $flag = TaskRepo::refund($data);       
        if($flag['status']==true) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
        }

        return back()->with('rs',$rs);
    }


}
