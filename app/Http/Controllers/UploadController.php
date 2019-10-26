<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
     /**
     * 接收上传文件
     * @param Request $request
     * @return array
     */
    public function upload( Request $request ){

        if ($request->isMethod('post')) {

            $file = $request->file('file');

            // 文件是否上传成功
            if ($file->isValid()) {

                $path = $this->uploadFile($file);               
                
                return response()->json(['rs' => true, 'msg' => '上传成功', 'data' => ['path' =>  '/storage/uploads/'.$path ]]);

            }

        }else{
            return response()->json(['rs' => false, 'msg' => '不是正确请求方式', 'data' => '']);
        }
    }

    private function uploadFile($file)
    {
        // 获取后缀名
        $ext      = $file->getClientOriginalExtension();    
        $saveName = time().rand().".".$ext;          
        $path     = $file->store(date('Ymd'));
        return $path;
    }
       
}
