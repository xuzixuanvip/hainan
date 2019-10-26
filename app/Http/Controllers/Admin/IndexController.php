<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskProcess;
use App\Repos\TaskRepo;
use Log,Session;
use App\Services\Wechat;

class IndexController extends Controller
{
    public function index()
    {
    	$tasks =Task::whereIn('status',['1','50','75'])->orderBy('created_at','desc')->take(10)->get();

        $where = [];
        if(Session::has('admin')) {
         if(session('admin')->role_id == 1) {
    //        $where['user_id'] = session('admin')->id;
        }
        

        if(session('admin')->role_id == 2) {
     //       $where['depart_id'] = session('admin')->depart_id;
        }
        }
        $where['status'] = 1;
        $wait    = Task::where($where)->count();
        $where['status'] = 50;
        $process = Task::where($where)->count();
        $where['status'] = 100;
        $done    = Task::where($where)->count();
        $where['status'] = 75;
        $price = Task::sum('money');
        unset($where['status']);
        $tasks_total = Task::where($where)->count();

        $workers = User::where('role_id',1)->get();
    	
    	return view('admin.index',compact('data','tasks','wait','process','done','price','tasks_total','workers'));
    }

    public function refund(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        $data = $request->all();
        $data['username'] = session('admin')->username.'('.session('admin')->truename.')';
        $flag = TaskRepo::refund($data);       
        if($flag['status']==true) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
        }

        return back()->with('rs',$rs);

    }

    /**
     * 派工
     */
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

    public function test()
    {
        $code = 'new_to_user';
        $data['task_id'] = 12;
        $data['openid'] = 'oYIp_1uCdkAJK9n5kgQGkJ1AdlxM';
        $data['code'] = '292390320230230';
        $data['time'] = Date('Y-m-d H:i:s');
        $data['first'] = '提交成功';  
        $data['remark'] = '您的信息已经提交';     
        $rs = Wechat::sendMsgTpl($code,$data);
        dd($rs);
    }
}
