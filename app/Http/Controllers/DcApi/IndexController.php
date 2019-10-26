<?php

namespace App\Http\Controllers\DcApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanUser;
use App\Models\DiancanNotice;
use DB,Log;
use App\Services\BaiduAi;
use App\Http\Requests\ApiRequest;

class IndexController extends Controller
{
    

    public function logDo(Request $request)
    {
        //$wechat_user =  session('wechat.oauth_user.default');
       
        $rs['status']      = true;
        $where['mobile']   = $request->mobile;
        $where['password'] = $request->password;
        $flag = DiancanUser::where($where)->first();
        if(empty($flag)) {
            $rs['status'] = false;
            $rs['msg'] = '账号不存在';
            return response()->json($rs);

        }
        $url = '/diancan-h5/index.html?code='.$flag->token;
        return redirect($url);

    }

    public function notice(Request $request)
    {
        $rs['status'] = true;
        $id = (int)$request->id;
        $data = DiancanNotice::find($id);
        $rs['data'] = $data;
        return response()->json($rs);
    }

    public function resetMoney()
    {

        DiancanUser::query()->update(['money'=>DB::raw("`day_money`")]);
    }

    public function upload(Request $request)
    {
        $rs['status'] = false;
        $folder       = 'file/'.date('Ymd').'/';
        
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

    public function faceMatch(ApiRequest $request)
    {
        $rs['status'] = false;
        $where['id'] = $request->user_id;
        $pic    = ltrim($request->pic,'/');
        $user   = DiancanUser::where($where)->first();
        $avatar = ltrim($user->avatar,'/');
        $res    = BaiduAi::faceMatch($avatar,$pic);
        Log::info('人脸比对结果'.json_encode($res));
        if($res['status']==true) {
            $rs['status'] = true;
            $rs['data'] = $res;
            return response()->json($rs);
        }
        return response()->json($rs);
    }

    
}
