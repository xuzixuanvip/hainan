<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\OutstockRepo;
use App\Repos\GoodsRepo;
use App\Models\Room;
use DB;


class OutstockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [];
        $list = OutstockRepo::pages($where);
        return view('admin.outstock.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods = GoodsRepo::get();
        $rooms = Room::all();
        return view('admin.outstock.add',compact('rooms','goods'));
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
        
        $flag   = OutstockRepo::store($data);
        if($flag['status'] == true) {
             $rs['status'] = 'success';
             $rs['msg']    = '操作成功';
            return redirect('zadmin/outstock')->with('rs',$rs);
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
        $data = OutstockRepo::find(['id'=>$id]);
        $rooms = Room::all();
        $goods = GoodsRepo::get();
        return view('admin.outstock.edit',compact('data','rooms','goods'));
    }

    public function print($id)
    {
        $data = OutstockRepo::find(['id'=>$id]);
        return view('admin.outstock.print',compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag = OutstockRepo::destroy($id);
       
            return back();
        
    }

    public function delGoods($id)
    {
        OutstockRepo::delGoods($id);
        return back();
    }

    public function saveGoods(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        OutstockRepo::saveGoods($data);
        return back();
    }

    public function updateGoods(Request $request)
    {
        $data = $request->except(['_token']);
        $flag = OutstockRepo::updateGoods($data);
        return back();
    }
}
