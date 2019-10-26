<?php
namespace App\Repos;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskProcess;
use DB,Log;
use App\Services\Wechat;

class TaskRepo
{
	

	

    public static function refund($data)
    {
        $rs['status'] = false;
        $rs['msg'] = '操作失败';
        $task = Task::find($data['task_id']);
        $task->status = 0;
        $flag = $task->save();

        // process表记录退单信息
        $process['task_id'] = $task->id;
        $process['remark'] = '被退单，退单原因:'.$data['refund_reason'].',操作人:'.$data['username'];
        $process['status'] = 0;
       
        TaskProcess::create($process);

        // 推送消息给提交者
        $msg = $task->toArray();
        $msg['first']      = '工单被退回';
       
        $msg['refund_reason'] = $data['refund_reason'];
           
        $msg['url']     = '';   

        Wechat::sendMsgTpl('refund',$msg);
        if($flag) {
            $rs['status'] = true;
            $rs['msg']    = '操作成功';
        }

        return $rs;
    }

    /**
     * 新单推送
     */
    public static function newTaskPush($data)
    {
        try {
            $msg = $data;            
            $msg['first']      = '您提交的新工单已生成';                 
            $msg['remark']     = '点击查看详情。';
            $msg['url']    = config('app.url').'/user/task/show/'.$data['id'];
            Wechat::sendMsgTpl('new_to_user',$msg);
            Log::info('新单：推送给用户成功');

            // 推送给超级管理员
            $managers = User::where('role_id',999)->get();
            foreach ($managers as $k => $v) {
                if(empty($v->openid)) continue;
                $msg2 = $msg;     
                $msg2['first']  = '您有新的报修信息到达！';
                $msg2['openid'] = $v->openid;               
                Wechat::sendMsgTpl('new_to_manager',$msg2);
                Log::info('新单：推送给超级管理员成功');          
            } 

            // 推送给负责的管理员
            $where['depart_id'] = $data['depart_id'];
            $where['role_id']   = 100; 
            $managers = User::where($where)->get();
            foreach ($managers as $k => $v) {
                if(empty($v->openid)) continue;
                $msg2 = $msg;     
                $msg2['first']  = '您有新的报修信息到达！';
                $msg2['openid'] = $v->openid;               
                Wechat::sendMsgTpl('new_to_manager',$msg2);
                Log::info('新单：推送给部门负责人'.$v->username.'成功');          
            } 


            // 如果是自动派单给维修工
            $system = SystemRepo::find();
            if($system->dispatch_type == 2) {
                $where['depart_id'] = $data['depart_id'];
                $where['role_id']   = 1;
                $users = User::where($where)->get();
                foreach ($users as $k => $user) {
                    if(empty($user->openid)) continue;
                    $processData['task_id']       = $data['id'];
                    $processData['worker_id']     = $user->id;
                    $processData['worker_openid'] = $user->openid;
                    self::process($processData);
                    $msg['openid'] = $user->openid; //派工通知用户 
                    $msg['first'] = '有新的工单请及时处理';  
                    $msg['remark'] = '点击查看详情';
                   
                    Wechat::sendMsgTpl('dispatch_to_worker',$msg); 
                    Log::info('新单：自动派单'.$v->username.'成功');                 
                }
            }    
        } catch (\Exception $e) {
            Log::error('新单推送失败：'.$e->getMessage());
        }
            
    }

    /**
     * 派工
     */
    public static  function dispatch($request)
    {
       
        $worker = User::find($request->worker_id);
        $task   = Task::find($request->task_id);

        $data = $request->except(['_token']);
        
        $data['worker_openid'] = $worker->openid; 
        
        $flag = self::process($data);  

        $msg = $task->toArray();              
        $msg['openid'] = $worker->openid; //派工通知用户 
        $msg['first']  = '有新的工单请及时处理';  
        $msg['remark'] = '点击查看详情';
        $msg['time']   = date('Y-m-d H:i:s'); 
        $msg['url']    = config('app.url').'/user/task/show/'.$task->id;
        Wechat::sendMsgTpl('dispatch_to_worker',$msg);

        // 推送消息
        $msg2 = $msg;
        $msg2['first']  = '您的工单已经派工！';       
        $msg2['worker_name']   = $worker->truename;
        $msg2['worker_phone']  = $worker->mobile;      
              
        Wechat::sendMsgTpl('dispatch_to_user',$msg2);

        
        if($flag) return true;
        return false;
    }

    private static function process($data)
    {        
        $data = array_only($data,['task_id','worker_id','worker_openid','remark']);
        $data['status'] =  50;  
        TaskProcess::create($data);

        $updateData = array_only($data,['worker_id','status']);       
        $flag = Task::where('id',$data['task_id'])->update($updateData);
        return $flag;
    }


    

	
	
}