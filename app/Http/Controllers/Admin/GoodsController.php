<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\GoodsCate;
use App\Repos\GoodsRepo;
use App\Imports\GoodsImport;
use Maatwebsite\Excel\Facades\Excel;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $query = Goods::query();
        if($request->keyword) {
            $where['keyword'] = $request->keyword;
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $list = $query->paginate(10);
       
        return view('admin.goods.index',compact('list','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = GoodsCate::get();
        return view('admin.goods.add',compact('cates'));
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
        
        $flag = GoodsRepo::create($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/goods')->with('rs',$rs);
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
        $data = Goods::find($id);  
        $cates = GoodsCate::get();     
        return view('admin.goods.edit',compact('data','cates'));
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
       
        $rs   = Goods::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/goods');
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
        $rs = Goods::destroy($id);
        if ($rs) {
            return redirect('zadmin/goods');
        }
        return back();
    }

    public function import(Request $request)
    {
        Excel::import(new GoodsImport, request()->file('excel'));
        return back();

    }

    public function bathDel(Request $request)
    {
        $rs['status'] = false;
        $ids = $request->ids;
        $flag = Goods::where('id',$ids)->delete();
        if($flag) {
            $rs['status'] = true;
            return response()->json($rs);
        }
         return response()->json($rs);
    }

    
}
