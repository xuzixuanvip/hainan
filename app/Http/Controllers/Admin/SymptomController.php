<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kfsymptom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $query = Kfsymptom::query();
        if ($request->keyword){
            $where['keyword'] = $request->keyword;
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $list = $query->paginate(10);

        return view('admin.symptom.index',compact('list','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.symptom.add');
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
        $rs['msg']    = '操作失败';
        $data = $request->except('_token');
        $flag = Kfsymptom::create($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/symptom')->with('rs',$rs);
        }
        $rs['msg'] = $flag['msg'];
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

        $data = Kfsymptom::find($id);

        return view('admin.symptom.edit',compact('data'));
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

        $rs   = Kfsymptom::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/symptom');
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
        \DB::table('body_symptom')->where('symptom_id',$id)->delete();
        \DB::table('symptom_diseases')->where('symptom_id',$id)->delete();
        $rs = Kfsymptom::destroy($id);
        if ($rs) {
            return redirect('zadmin/symptom');
        }
        return back();
    }

    public function bathDel(Request $request)
    {

        $rs['status'] = false;
        $ids = $request->ids;
        $flag = Kfsymptom::where('id',$ids)->delete();
        if($flag) {
            $rs['status'] = true;
            return response()->json($rs);
        }
        return response()->json($rs);
    }
}
