<?php

namespace App\Http\Controllers\Dz;

use App\Models\kfBody;
use App\Models\Kfdisease;
use App\Models\Kfsymptom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function MongoDB\BSON\fromJSON;

class ApiDzController extends Controller
{
    public function tags(Request $request)
    {
        $tags = \DB::table('kf_tags')->get();
        return $this->success($tags);
    }


    public function symptom(Request $request)
    {
        $symptom = \DB::table('kf_symptom')->get()->pluck('name','id');

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


    public function bodySearch(Request $request)
    {
        if($request->type == 'son'){
            $data = \DB::table('kf_bodys')->where('sex',$request->gender)->orWhere('pid',$request->id)->get();
        } else {
            $data = \DB::table('kf_bodys')->where('sex',$request->gender)->where('id',$request->id)->orWhere('pid',$request->id)->get();
        }
        return $this->success($data);
    }

    public function bodyTab(Request $request,kfBody $body)
    {
        $son = $body->with('symptom')->find($request->id)->symptom->pluck('name','id');
        return $this->success($son);
    }

    public function symptomSearch(Request $request,Kfdisease $disease)
    {
        $symptom = \DB::table('symptom_diseases')
                    ->where('symptom_id',$request->symptom_id)
                    ->orderBy('probability','desc')->offset(0)
                    ->limit(5)
                    ->get()
                    ->pluck('diseases_id');
        $data['symptoms'] = [];
        foreach($disease->find($symptom) as $v){
            foreach($v->symptom_disease->pluck('name') as $k =>$vv){
                if(!in_array($vv,$data['symptoms'])){
                    $data['symptoms'][] = $vv;
                }
            }
        }
        return $this->success($data);
    }

    public function fenxi(Request $request,Kfsymptom $symptom)
    {
        $symptom_data = $symptom->select('id','name')->find($request->symptom_id)->symptom_disease->all();
        $data = [];
        foreach ($symptom_data as $k=> $v) {
            $data['symptoms'] = $v->symptom_disease->pluck('name');
            $data['diseases'] = $symptom_data;
            $data['diseases'][$k]['pro'] = $v->pivot->probability;
            $data['diseases'][$k]['symptoms_text'] = $v->symptom_disease->pluck('name');
        }
        return $this->success($data);

    }


    public function diseaseRetrieve(Request $request,Kfdisease $disease)
    {
        $data = [];
        $data['xgzds'] = $disease->find($request->diseases_id);
        $data['jzkses'] =   $data['xgzds']->department->pluck('name');
        $data['symptoms'] =  $data['xgzds']->symptom_disease->pluck('name');
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
