<?php

namespace App\Http\Controllers\TaskApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repos\DepartRepo;
use DB,Log;


class IndexController extends Controller
{
    public function getCates(Request $request) 
    {
        $rs['status'] = true;
        $cates   = Category::select('id','name')->get();
        $rs['data'] = $cates;
        return response()->json($rs);
    }

    public function getDeparts(Request $request)
    {
        $rs['status'] = true;
        $departs = DepartRepo::get(['pid'=>0]);
        $rs['data'] = $departs;
        return response()->json($rs);
    }


    public function upload(Request $request)
    {
        $rs['status'] = false;
        $folder       = 'task/'.date('Ymd').'/';
        
        if ($request->isMethod('post')) {

            $file = $request->file('file');

            // 文件是否上传成功
            if ($file->isValid()) {
                $savepath = '/public/'.$folder;
                $filename = $this->uploadFile($file,$savepath);
                //dd($filename);               
                $rs['status'] = true;
                $rs['data'] = '/storage/'.$folder.$filename;
                return response()->json($rs);
            }

        }
        return response()->json(['rs' => false, 'msg' => '不是正确请求方式']);
    }

    private function uploadFile($file,$path)
    {
        // 获取后缀名
        $ext      = $file->getClientOriginalExtension();    
        $saveName = time().rand().".".$ext;          
        $path     = $file->storeAs($path,$saveName);
        return $saveName;
    }


    

   

    

}
