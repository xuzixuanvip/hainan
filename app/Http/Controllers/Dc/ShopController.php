<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanProduct;
use App\Models\DiancanType;
use App\Models\DiancanShop;
use App\Models\DiancanShopUser;
use App\Models\DiancanProductCate;


class ShopController extends Controller
{
    public function home(Request $request)
    {
        
       
        $id = session('dcadmin')->shop_id;
        $data  = DiancanShop::find($id);
        return view('dingcan.shop.edit',compact('data'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token','id']);
        if ($request->hasFile('pic')) {           
            $filename = date('YmdHis').'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);            
            $data['pic']  = '/storage/pic/'.$filename; 
        }
        $where['id'] = $request->id;
        $shop = DiancanShop::where($where)->update($data);
        return back(); 
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
