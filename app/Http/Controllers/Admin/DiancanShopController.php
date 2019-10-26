<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanShop;
use App\Models\DiancanShopUser;
use App\Models\Wxuser;
use DB;

class DiancanShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = DiancanShop::get();
        return view('admin.diancanshop.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wxusers = Wxuser::get();
        return view('admin.diancanshop.add',compact('wxusers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token','password']);

        if ($request->hasFile('pic')) {           
            $filename = date('YmdHis').'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);            
            $data['pic']  = '/storage/pic/'.$filename; 
        } 
        try {
            DB::beginTransaction();
            $shop = DiancanShop::create($data);
            $shopUser['shop_id']  = $shop->id;
            $shopUser['name']     = $request->contacter;
            $shopUser['password'] = mt_rand(100000,999999);
            $shopUser['mobile']   = $request->mobile;
            $shopUser['rank']     = 100;
            DiancanShopUser::create($shopUser);
            DB::commit();
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback(); 
        }
        

        
        return back();
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
        $data = DiancanShop::find($id);
        return view('admin.diancanshop.edit',compact('data','wxusers'));
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
        $data = $request->except(['_method','_token','password']);

        if ($request->hasFile('pic')) {           
            $filename = date('YmdHis').'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);            
            $data['pic']  = '/storage/pic/'.$filename; 
        } 
        if($request->status) {
            $data['status'] = 1;
        }else {
            $data['status'] = 0;
        }
        DiancanShop::where('id',$id)->update($data);
        $shopUser['mobile'] = $request->mobile;
        if($request->password) {
            $shopUser['password'] = $request->password;    
        }
        
        $userWhere['shop_id'] = $id;
        $userWhere['rank'] = 100;
        DiancanShopUser::where($userWhere)->update($shopUser);
        return redirect('zadmin/diancan/shops');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiancanShop::destroy($id);
        DiancanShopUser::where(['shop_id'=>$id])->delete();
        return back();
    }
}
