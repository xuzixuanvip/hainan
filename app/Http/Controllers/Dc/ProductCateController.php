<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanProduct;
use App\Models\DiancanType;
use App\Models\DiancanProductCate;

class ProductCateController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        $where['shop_id'] = session('dcadmin')->shop_id;
        //dd($where);
        $list  = DiancanProductCate::where($where)->paginate(10);
       // dd($list);
        return view('dingcan.product-cate.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = DiancanType::get();
        $cates = DiancanProductCate::get();
        return view('dingcan.product-cate.add',compact('types','cates'));
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
        $data['shop_id'] = session('dcadmin')->shop_id;
       
        $flag = DiancanProductCate::create($data);
        return redirect('diancan/shop/cates');
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
        
        $data = DiancanProductCate::find($id);
        $products = DiancanProduct::where(['cate_id'=>$id])->get();
        return view('dingcan.product-cate.edit',compact('data','products'));
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
        $data['shop_id'] = session('dcadmin')->shop_id;
       
        $flag = DiancanProductCate::where(['id'=>$id])->update($data);
        return redirect('diancan/shop/cates');
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
        $where['cate_id'] = $id;
        $product_num = DiancanProduct::where($where)->count();
        if($product_num>0) {
            $rs['msg'] = '请先删除分类下的菜品';
            return back()->with('rs',$rs);
        }
        DiancanProductCate::destroy($id);
        $rs['status'] = 'success';
        $rs['msg']    = '操作成功';
        return back()->with('rs',$rs);
    }
}
