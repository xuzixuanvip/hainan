<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Emergency;
use App\Models\System;
use App\Models\Notice;
use Log;

class EmergencyController extends Controller
{
    public function index()
    {
        $system = System::first();
        $notice = Notice::find(3);
        return view('hrs.task.emergency',compact('system','notice'));
    }

    /**
     * 意见呼叫
     */
    public function senMessage(Request $request)
    {    	
        $rs['status'] = 'success';
        $room = $request->room;
        $txt  = $room.' 在科室，受到威胁，请速度去处理！一线医护人员受到威胁，请尽快！并在微信群内回复。';  
        $emergencys = Emergency::get();

        
       
    	
        foreach($emergencys as $emerg) {
            if($emerg->is_msg) {
                $flag  = $this->batchSend($txt,$emerg->mobile);    
            }
            if($emerg->is_voice) {
                $flag2  = $this->voiceMsg('110110',$emerg->mobile);    
            }
            
            //dd($flag2);    
        }

        $rs['msg'] = "<p>一支穿云箭,千军万马来相见</p><p>两副忠义胆,刀山火海提命现</";
        return back()->with('rs',$rs);
        
    }

    public function test()
    {
        $room = '一楼';
        $txt  = $room.' 在科室，受到威胁，请速度去处理！一线医护人员受到威胁，请尽快！并在微信群内回复。';  
       
       
        $flag  = $this->batchSend($txt,'15953204819');
        dd($flag);
    }

    
}
