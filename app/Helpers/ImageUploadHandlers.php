<?php

namespace App\Helpers;

use \Predis\Response;


class ImageUploadHandlers
{
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file,$cate)
    {
        if(!$file->isValid()){
            return $this->response(['code'=>400,'msg'=>'上传文件不合法']);
        }

        $dir_name = "uploads/images/$cate/" . date("Ym/d");

        $upload_path = public_path() . '/' . $dir_name;

        if($file->getClientOriginalExtension() == ''){
            return $this->response(['code'=>400,'msg'=>'上传文件不合法']);
        }
        $extentsion = strtolower($file->getClientOriginalExtension());

        $filename = $cate . '_' . time() . '_' . str_random(10) . '.' . $extentsion;

        if (!in_array($extentsion, $this->allowed_ext)) {
            return $this->response(['code' => 400, 'msg' => '上传文件不合法']);
        }
        if ($file->move($upload_path, $filename)) {
           return $this->response(['code' => 200, 'msg' => \Request::server('HTTP_HOST'). '/' . $dir_name . '/' . $filename]);
        } else {
            return $this->response(['code' => 400, 'msg' => '上传失败']);
        }

    }

    public function save2($file,$cate)
    {
        if(!$file->isValid()){
            return['code'=>400,'msg'=>'上传文件不合法'];
        }

        $dir_name = "uploads/images/$cate/" . date("Ym/d");

        $upload_path = public_path() . '/' . $dir_name;

        if($file->getClientOriginalExtension() == ''){
            return ['code'=>400,'msg'=>'上传文件不合法'];
        }
        $extentsion = strtolower($file->getClientOriginalExtension());

        $filename = $cate . '_' . time() . '_' . str_random(10) . '.' . $extentsion;

        if (!in_array($extentsion, $this->allowed_ext)) {
            return ['code' => 400, 'msg' => '上传文件不合法'];
        }
        if ($file->move($upload_path, $filename)) {
            return ['code' => 200, 'msg' => '/' . $dir_name . '/' . $filename];
        } else {
            return ['code' => 400, 'msg' => '上传失败'];
        }

    }
    public function response($data)
    {
        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}