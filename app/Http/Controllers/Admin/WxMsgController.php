<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Wechat;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\Storage;

class WxMsgController extends Controller
{
    public function sendMsg(Request $request)
    {
        $openid =$request->openid;
        $app = app('wechat.official_account');

       
        $message = new Text($request->msg);

        $result = $app->customer_service->message($message)->to($openid)->send();
        if($result['errcode']==0) {
            return back();
        }else {
            dd($result['errmsg']);
        }
       
    }

    
}
