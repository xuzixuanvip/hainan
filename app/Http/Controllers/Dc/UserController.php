<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanShopUser;
use App\Models\Wxuser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where=[];
        $where['shop_id'] = session('dcadmin')->shop_id;
        $list = DiancanShopUser::where($where)->paginate(10);
        return view('dingcan.user.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wxusers = Wxuser::all();
        return view('dingcan.user.add',compact('wxusers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('token');
        $data['shop_id'] = session('dcadmin')->shop_id;
        $data['rank']    = 1;
        $flag = DiancanShopUser::create($data);
        return redirect('diancan/shop/users');
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
        $wxusers = Wxuser::all();
        $data = DiancanShopUser::find($id);
        return view('dingcan.user.edit',compact('data','wxusers'));
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
        $data    = $request->except(['_token','_method']);
        $shop_id = session('dcadmin')->shop_id;
        $where['shop_id'] = $shop_id;
        $where['id']      = $id;
        $flag    = DiancanShopUser::where(['id'=>$id])->update($data);
        return redirect('diancan/shop/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag    = DiancanShopUser::destroy($id);
        return redirect('diancan/shop/users');
    }
}
