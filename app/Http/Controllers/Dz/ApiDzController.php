<?php

namespace App\Http\Controllers\Dz;

use App\Models\kfBody;
use App\Models\Kfdepartment;
use App\Models\Kfdisease;
use App\Models\Kftags;
use App\Models\Kfsymptom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function MongoDB\BSON\fromJSON;

class ApiDzController extends Controller
{
    public function tags(Request $request)
    {
        $tags = \DB::table('kf_tags')->where('status',1)->get();
//
        return $this->success($tags);
    }


    public function symptom(Request $request,Kftags $tag)
    {
        $tag_msg = $tag->find($request->id)->tags_count->pluck('name','id');
//        $symptom = \DB::table('kf_symptom')->get()->pluck('name','id');

        return $this->success($tag_msg);
    }

    public function search(Request $request)
    {

        $symptom = \DB::table('kf_symptom')->where('name','like','%'. $request->keyword.'%')->take(5)->get()->pluck('name','id');
        $diseases = \DB::table('kf_diseases')->where('name','like','%'. $request->keyword.'%')->take(5)->get()->pluck('name','id');
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

    public function symptomSearch(Request $request,Kfdisease $disease,Kfsymptom $symptom)
    {
        $data = [];
        $symp_name = explode(';',$request->symptom_word);
        $data_id = $symptom->whereIn('name',$symp_name)->get()->pluck('id');

        $disease_id = \DB::table('kf_symptom_diseases')
                    ->where('symptom_id',$data_id)
                    ->orderBy('probability','desc')
                    ->offset(0)
                    ->limit(5)
                    ->get()
                    ->pluck('diseases_id');
        $symptom_diseases = \DB::table('kf_symptom_diseases')
                                ->whereIn('diseases_id',$disease_id)
                                ->orderBy('probability','desc')
                                ->offset(0)
                                ->limit(20)
                                ->get()
                                ->pluck('symptom_id');
        $data_id = json_decode($data_id,true);
        foreach($symptom_diseases as $k => $v){
            if(in_array($v,$data_id)){
                unset($symptom_diseases[$k]);
            }
        }
        $data['symptoms'] = $symptom->find($symptom_diseases)->pluck('name');
        $disease_msg = $disease->find($disease_id);
        $data['disease'] = $disease_msg;
//
        return $this->success($data);
    }

    public function fenxi(Request $request,Kfsymptom $symptom,Kfdisease $disease)
    {
        $data = [];
        if(substr_count($request->symptom_word,';') != 0) {
            $symp_name = explode(';',$request->symptom_word);
        } else {
            $symp_name = array($request->symptom_word);
        }
        $data_id = $symptom->whereIn('name',$symp_name)->get()->pluck('id');
        $symptom_ids = $symptom->offset(0)->limit(5)->find($data_id)->pluck('id');

        $symptom_data = \DB::table('kf_symptom_diseases')
                    ->whereIn('symptom_id',$symptom_ids)
                    ->orderBy('probability','desc')
                    ->offset(0)
                    ->limit(5)
                    ->get()
                    ->pluck('diseases_id','probability');
        $symptom_data = $this->a_array_unique($symptom_data);
        $disease_msg = $disease->find($symptom_data);
        $data['disease'] = $disease_msg;
        $data['symptoms'] = [];
        foreach($disease_msg as $k=>$v){
            $data['disease'][$k]['symptom'] = $v->symptom_disease->pluck('name');

            $data['symptoms'] =  $v->symptom_disease->pluck('name');
            foreach ($v->symptom_disease as $vv){
                $data['disease'][$k]['pro'] = $vv->pivot->probability;
            }
        }
        $data['department'] = $data['disease'][0]->department != null ? $data['disease'][0]->department : '暂无推荐';
        return $this->success($data);
    }


    public function diseaseRetrieve(Request $request,Kfdisease $disease)
    {
        $data = [];
        $id = \DB::table('kf_diseases')->where('name',$request->diseasename)->first()->id;
        $data['xgzds'] = $disease->find($id);
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


    function a_array_unique($array)
    {
        $out = array();
        foreach ($array as $key=>$value) {
            if (!in_array($value, $out))
            {
                $out[$key] = $value;
            }
        }
        return $out;
    }


    /**
     * 名医点击api
     * @param Request $request
     */
    public function doctor(Request $request)
    {
//        $data = \DB::table('kf_doctor_department')->where('department_id',$request->id)->get();
        $department = Kfdepartment::find($request->id);
        $doctor = $department->doctor;
        return $this->response($doctor,'成功', $doctor);
    }
}
