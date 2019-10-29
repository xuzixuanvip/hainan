<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kfsymptom;
use Illuminate\Support\Facades\DB;
use App\Models\Kftags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $list = Kftags::query();
        if ($request->keyword){
            $where['keyword'] = $request->keyword;
            $list->where('name','like','%'.$request->keyword.'%');
        }
        $list = $list->paginate(10);

        return view('admin.tags.index',compact('list','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = Kftags::find($id);
        $result = Kfsymptom::all();
        $rs = $data->tags()->get();
        $rsrs = [];
        foreach ($rs as $k=>$v){
            $rsrs[] = $v->id;
        }
        return view('admin.tags.edit',compact('data','result','rsrs'));
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
        $tags_id = $id;
        $symptom_id  = $request->symptom_id;
        $arr = [];
        $member = [];
        foreach($symptom_id as $k=>$v){
            $arr['tags_id'] = $tags_id;
            $arr['symptom_id'] = $v;
            $member[] = $arr;
        }
        $delete = DB::table('tags_symptom')->where('tags_id',$id)->delete();
        $data = DB::table('tags_symptom')->insert($member);
        $rs['status'] = 'danger';
        $rs['msg'] = '操作失败';
        if ($data){
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return redirect('zadmin/tags')->with('rs',$rs);
        }
        $rs['mag'] = $flag['msg'];
        return back()->withInput()->with('rs',$rs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
