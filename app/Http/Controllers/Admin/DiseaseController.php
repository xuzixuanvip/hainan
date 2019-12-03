<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kfdepartment;
use App\Models\Kfdisease;
use App\Models\Kfsymptom;
use App\Models\Kftags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Traits\MessageTraits;

class DiseaseController extends Controller
{
    use MessageTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $flag = Kfdisease::query();
        if($request->keyword){
            $where['keyword'] = $request->keyword;
            $flag->where('name','like','%'.$request->keyword.'%');
        }
        $list = $flag->paginate(10);
        return view('admin.disease.index',compact('list','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kfdepartment $department)
    {
        $department =  $department->get();
        return view('admin.disease.add',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        $request = $request->except($request->_token);
        $flag = Kfdisease::create($request);
        \DB::table('kf_diseases_dwebepartment')->insert(['diseases_id'=>$flag->id,'department_id'=>$request['department_id']]);
        if ($flag){
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return redirect('zadmin/disease')->with('rs',$rs);
        }
        $rs['mag'] = $flag['msg'];
        return back()->withInput()->with('rs',$rs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Kfdepartment $department)
    {
        $data = Kfdisease::find($id);
        $department =  $department->get();
        $department_id =  \DB::table('kf_diseases_department')->where('diseases_id',$id)->get()->pluck('department_id')->all();
        $department_id = empty($department_id)  ? 0 : $department_id;
        return view('admin.disease.edit',compact('data','department','department_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method','department_id');
        $flag = Kfdisease::where('id',$id)->update($data);
        $flag2= \DB::table('kf_diseases_department')->where('diseases_id',$id)->update(['department_id'=>$request->department_id]);
        if ($flag || $flag2){
            return redirect('zadmin/disease');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Kfdisease::find($id)->symptom_disease()->detach();
        \DB::table('kf_diseases_department')->where('diseases_id',$id)->delete();
        $flag = Kfdisease::destroy($id);
        if ($flag){
            return redirect('zadmin/disease');
        }
        return back();
    }
    public function bathDel(Request $request)
    {

        $rs['status'] = false;
        $ids = $request->ids;
        $flag = Kfdisease::where('id',$ids)->delete();
        if($flag) {
            $rs['status'] = true;
            return response()->json($rs);
        }
        return response()->json($rs);
    }
    public function dorela($id)
    {
        $data = Kfdisease::find($id);

        $result = Kfsymptom::all();

        $proba = DB::table('kf_symptom_diseases')->where('diseases_id',$id)->get();
        $rs = $data->symptom_disease()->get();
        $rsrs = [];
        foreach ($rs as $k=>$v){
            $rsrs[] = $v->id;
//            $rsrs[]['pro'] = $proba$v->id;
        }
        $tag = Kftags::select('id','name')->get();
//        dd($rs);
        return view('admin.disease.symptom',compact('data','result','rsrs','proba','rs','tag'));
    }

    public function insertdata(Request $request,$id)
    {
        $disease_id = $id;
        $symptom_id  = $request->symptom_id;
        $arr = [];
        $member = [];
        foreach($symptom_id as $k=>$v){
            $arr['diseases_id'] = $disease_id;
            $arr['symptom_id'] = $v;
            $arr['probability'] = $request->input('probability'.$v);
            $member[] = $arr;
        }
        $delete = DB::table('kf_symptom_diseases')->where('diseases_id',$id)->delete();
        $data = DB::table('kf_symptom_diseases')->insert($member);
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        if ($data){
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return redirect('zadmin/disease')->with('rs',$rs);
        }
        $rs['mag'] = $flag['msg'];
        return back()->withInput()->with('rs',$rs);
    }

    public function search(Request $request,Kfdisease $disease)
    {
        $msg = $disease->where('name','like','%'.$request->name.'%')->first();
        if($msg) {

            $msg2 =  $msg->symptom_disease->pluck('id');

            if($msg2) {

                $data = ['code'=>200,'msg'=>'成功~','data'=>$msg2,'data2'=>$msg];

            } else {

                $data = ['code'=>400,'msg'=>'没有该疾病~'];

            }

        } else {

            $data = ['code'=>400,'msg'=>'没有该疾病1~'];

        }

        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function tag_search(Request $request)
    {
        $tag_id = DB::table('kf_tag_symptom')->where('tag_id',$request->id)->get()->pluck('symptom_id');
        if($tag_id){
            $data = ['code'=>200,'msg'=>'成功','data'=>$tag_id];
        }else {
            $data = ['code'=>400,'msg'=>'失败'];
        }
        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

}
