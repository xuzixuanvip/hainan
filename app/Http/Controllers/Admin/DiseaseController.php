<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kfdisease;
use App\Models\Kfsymptom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DiseaseController extends Controller
{
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
    public function create()
    {
        return view('admin.disease.add');
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
    public function edit($id)
    {
        $data = Kfdisease::find($id);

        return view('admin.disease.edit',compact('data'));
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
        $data = $request->except('_token','_method');
        $flag = Kfdisease::where('id',$id)->update($data);
        if ($flag){
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

        $rs = $data->symptom_disease()->get();
        $rsrs = [];
        foreach ($rs as $k=>$v){
            $rsrs[] = $v->id;
        }
        return view('admin.disease.symptom',compact('data','result','rsrs'));
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
            $member[] = $arr;
        }
        $delete = DB::table('symptom_diseases')->where('diseases_id',$id)->delete();
        $data = DB::table('symptom_diseases')->insert($member);
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
}
