<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Worklog;
use App\Models\User;
use App\Services\BaiduAi;
use FFMpeg;


class IndexController extends Controller
{
    public function index()
    {
    	
        return view('hrs.index');
    }

    /**
     * 发送短信
     */
    public function sendmsg(Request $request)
    {
    	$rs['status'] = false;
        $action = 'login';
        if($request->action) {
            $action = $request->action;
        }
        $checkRs = $this->checkStauts($request->mobile,1,$action);
       
        if(!$checkRs['status']) {
            $rs['msg'] = $checkRs['msg'];
            return $rs;
        }

        // if(session('smscode')) {
        //     $rs['status'] = true;
        //     $rs['data']   = session('smscode');
        //     $rs['msg']    = '短信验证码4小时内有效';
        //     return $rs;
        // }

    	$result       = $this->sendsms($request->mobile);
    	if($result['status']) {
    		$rs['status'] = true;
    		$rs['data']   = $result['data'];
            $rs['msg']    = '短信验证码已发送';
    		session(['smscode' => $result['data'] ]);
            return $rs;
    		
    	}
        $rs['msg'] = $result['msg'];
    	return response()->json($rs);

    }

    public function getArea(Request $request)
    {
        $rs['status'] = false;
        if(empty($request->num)) {
            $rs['msg'] = '请选择地区';
            return $rs;
        }
        
        $list = $this->getDistrict($request->num);
        if($list) {
            $rs['status'] = true;
            $rs['data'] = $list;
            return $rs;
        }
        $rs['msg'] = '信息错误';
        return $rs;
    }

      public function worklog()
    {           
        $param = [];        
        $list = Worklog::orderBy('id','desc')->paginate(10);

        //dd($list->count());
        return view('info.worklog',compact('list','param'));
    }

    public function notice()
    {           
        $param = [];            
        $list = Notice::orderBy('id','desc')->paginate(10);
        return view('info.notice',compact('list','param'));
    }

    public function noticeShow($id)
    {
        $data = Notice::find($id);
        return view('info.notice-show',compact('data'));
    }

    public function worker()
    {           
        $param = [];
        $where['role_id'] = 1;      
        $list = User::where($where)->paginate(10);
       
        return view('info.worker',compact('list','param'));
    }

    public function test()
    {
           FFMpeg::open('1201-1.mp4')
        ->getFrameFromSeconds(10)
        ->export()        
        ->save('FrameAt10sec.png');
    }

    public function AiTest()
    {
        BaiduAi::faceMatch();
    }


    
}
