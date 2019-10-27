<?php

namespace App\Http\Controllers\Admin\Traits;


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



}