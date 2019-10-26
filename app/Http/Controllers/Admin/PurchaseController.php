<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\PurchaseRepo;
use App\Repos\GoodsRepo;
use App\Models\Supply;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [];
        $list = PurchaseRepo::pages($where);
        return view('admin.purchase.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departs = GoodsRepo::get();
        // 供应商
        $supplies = Supply::get();
        return view('admin.purchase.add',compact('departs','supplies'));
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
        
        $rs   = PurchaseRepo::store($data);
        if($rs['status'] == true) {
             $rs['status'] = 'success';
             $rs['msg']    = '操作成功';
            return redirect('zadmin/purchases')->with('rs',$rs);
        }
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
        $data = PurchaseRepo::find(['id'=>$id]);
        return view('admin.purchase.edit',compact('data'));
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
        $data = $request->except('_token','_method','thumb');
        
        $rs   = PurchaseRepo::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/purchases');
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
        $rs = PurchaseRepo::destroy($id);
        if ($rs) {
            return redirect('zadmin/purchases');
        }
        return back();
    }
}
