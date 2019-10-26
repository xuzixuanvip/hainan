<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\MessageRepo;
use App\Models\Yijian;

class MessageController extends Controller
{
    /**
     * 留言
     */
    public function index(Request $request)
    {
    	$where = [];    	
    	$list  = MessageRepo::pages($where);
    	return view('hrs.task.message_new',compact('list','where'));
    }

    /**
     * 留言
     */
    public function new(Request $request)
    {
        $where = [];
        $where['pid'] = 0;        
        $list  = MessageRepo::pages($where);
        return view('hrs.task.message_new',compact('list','where'));
    }

    public function save(Request $request)
    {
        $rs['status'] = 'danger'; 
        $rs['msg']    = '保存失败';
        $data = $request->except(['_token']);
        $wechat_user    =  session('wechat.oauth_user.default');
        $data['avatar']   = $wechat_user->avatar;
        $data['openid']   = $wechat_user->id;
        $data['nickname'] = $wechat_user->nickname;
        $flag = MessageRepo::save($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '提交成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }

    public function reply(Request $request)
    {
        $rs['status'] = 'danger'; 
        $rs['msg']    = '保存失败';
        $id = (int)$request->id;
        $msg = MessageRepo::find(['id'=>$id]);
        if($msg) {
            $msg->reply    = $request->reply;
            $msg->reply_at = date('Y-m-d H:i:s');
            $msg->status   = 1;
            $msg->save();
            $rs['status'] = 'success';
            $rs['msg']    = '回复成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }

    /**
     * 意见
     */
    public function yijian(Request $request) 
    {
    	return view('hrs.task.yijian',compact('param'));
    }

    public function yijianSave(Request $request) 
    {
        $rs['status'] = 'danger'; 
        $rs['msg']    = '保存失败';
        $data = $request->except(['_token']);
        $wechat_user  =  session('wechat.oauth_user.default');
       
        $data['openid']   = $wechat_user->id;
        $data['nickname'] = $wechat_user->nickname;
        $flag = Yijian::create($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '提交成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }
}
