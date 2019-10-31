<?php

namespace App\Http\Controllers\Dz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiDzController extends Controller
{
    public function tags(Request $request)
    {
        $tags = \DB::table('kf_tags')->get();
        return $this->success($tags);
    }


    public function symptom(Request $request)
    {
        $symptom = \DB::table('kf_symptom')->get()->pluck('name');

        return $this->success($symptom);
    }

    public function search(Request $request)
    {
        $symptom = \DB::table('kf_symptom')->where('name','like','%'. $request->keyword.'%')->get()->pluck('name');
        $diseases = \DB::table('kf_diseases')->where('name','like','%'. $request->keyword.'%')->get()->pluck('name');
        $data['symptom'] = $symptom;
        $data['diseases'] = $diseases;

        return $this->success($data);

    }




    public function response($model,$msg='',$data='',$code='')
    {
        if($model){
            return $this->success($data,$msg,$code);
        } else {
            return $this->error($msg,$code);
        }
    }

    public function error($msg='未知错误',$code= '400')
    {
        return response()->json(['code'=>$code,'msg'=>$msg])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function success($data,$msg='成功',$code='200')
    {
        return response()->json(['code'=>$code,'msg'=>$msg,'data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
