<?php

namespace App\Http\Controllers\Admin\Traits;


use http\Env\Response;

trait MessageTraits
{

    public function redirect_msg($model,$url='',$msg = '')
    {
        if($model) {
            return redirect()->to($url)->with('message', $msg . '修改成功！');
        } else {
            return back()->withErrors($msg.'失败~');
        }
    }


    public function json_msg($model,$msg='')
    {
        if($model) {
            return response()->json(['code'=>200,'msg'=>$msg.'成功~'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['code'=>400,'msg'=>$msg.'失败~'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

    }


}