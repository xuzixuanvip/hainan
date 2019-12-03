<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kfsymptom;
use App\Models\Kftags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tag;

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
//        dump($list[1]);
//        dd($list[1]->tags->pluck('name'));
        return view('admin.symptom.index',compact('list','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kftags $tag)
    {
        $tag = $tag->get()->pluck('name','id');
        return view('admin.symptom.add',compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Kfsymptom $kfsymptom)
    {
        $rs['status'] = 'danger';
        $rs['msg']    = '操作失败';
        $data = $request->except('_token','tags');
        $flag = Kfsymptom::create($data);
        $flag->tags()->attach($request->tags);//批量添加
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
    public function edit($id,Kftags $tag)
    {
        $data = Kfsymptom::find($id);
        $data_tag_id = $data->tags->pluck('id','name');
        $tag = $tag->get()->pluck('name','id');
        return view('admin.symptom.edit',compact('data','tag','data_tag_id'));
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
        $data = $request->except('_token','_method','tags');

        $rs   = Kfsymptom::where('id',$id)->update($data);
        if(!empty($request->tags)){
            $symptom = new Kfsymptom;
            $symptom = $symptom->find($id);
             $res2 =$symptom->tags()->sync($request->tags);//批量添加
            if($res2) {
                return redirect('zadmin/symptom');
            }
        }

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
        \DB::table('kf_body_symptom')->where('symptom_id',$id)->delete();
        \DB::table('kf_symptom_diseases')->where('symptom_id',$id)->delete();
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
