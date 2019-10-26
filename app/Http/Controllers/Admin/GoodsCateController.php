<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GoodsCate;
use App\Models\Goods;

class GoodsCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = GoodsCate::paginate(10);
        return view('admin.goodscate.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $flag = GoodsCate::create($data);
        if($flag) {
            return back();
        }
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
        $data = GoodsCate::find($id);
        return view('admin.goodscate.edit',compact('data'));
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
        $data = GoodsCate::find($id);
        $data->name = trim($request->name);
        $data->save();
        return redirect('zadmin/goodscates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs['status'] = 'danger';
        $Goods_num = Goods::where(['cate_id'=>$id])->count();
        if($Goods_num>0) {
            $rs['msg'] = '此分类下已有配件信息，请先删除或者修改配件信息，然后在删除';
            return back()->with('rs',$rs);
            
        }
        $flag = GoodsCate::destroy($id);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return back()->with('rs',$rs);
        }
    }
}
