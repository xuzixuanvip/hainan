<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanShopUser;
use App\Models\DiancanShop;
use App\Models\Wxuser;
use App\Models\Depart;

class DiancanShopUserController extends Controller
{
    
    public function index(Request $request)
    {
        $where = $param = [];
        $shops = DiancanShop::all();
        if($request->shop_id) {
            $where['shop_id'] = trim($request->shop_id);
        }
        $list = DiancanShopUser::where($where)->paginate(20);
        $wxusers = Wxuser::all();
        return view('admin.diancanshopuser.index',compact('list','wxusers','shops','param'));
    }

    public function create()
    {
        $wxusers = Wxuser::all();
        $shops = DiancanShop::all();
        return view('admin.diancanshopuser.add',compact('wxusers','shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = mt_rand(100000,999999);
       
        $flag = DiancanShopUser::create($data);
        return redirect('zadmin/diancan/shopusers');
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
        $wxusers = Wxuser::get();
        $data = DiancanShopUser::find($id);
       
        //dd($wxusers);
        return view('admin.diancanshopuser.edit',compact('data','wxusers'));
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
        $data = $request->except(['_token','_method']);
        $flag = DiancanShopUser::where('id',$id)->update($data);
        return redirect('zadmin/diancan/shopusers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag = DiancanShopUser::destroy($id);
        return back();
    }
}
