<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Wechat;
use Illuminate\Support\Facades\Storage;

class WxMaterialController extends Controller
{
    public function getMaterial(Request $request)
    {
        $type = object_get($request,'type','image');
        $app = app('wechat.official_account');
        // 图片素材
        $rs = $app->material->list($type, 0, 10);
        //dd($rs,$type);
        $list = $rs['item'];

        return view('admin.material.'.$type,compact('list'));
    }

    public function downVideo(Request $request)
    {
    	$app = app('wechat.official_account');
        $mediaId = $request->id;
        $rs = $app->material->get($mediaId);
        $fileContents = file_get_contents($rs['down_url']);
        Storage::put('video/'.$rs['title'].'.mp4', $fileContents);
        
       
    }
}
