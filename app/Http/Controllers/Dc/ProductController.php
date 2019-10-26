<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanProduct;
use App\Models\DiancanType;
use App\Models\DiancanProductCate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        $where['shop_id'] = session('dcadmin')->shop_id;
        $list  = DiancanProduct::where($where)->paginate(10);
        return view('dingcan.product.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $where['shop_id'] = session('dcadmin')->shop_id;
        $types = DiancanType::get();
        $cates = DiancanProductCate::where($where)->get();
        return view('dingcan.product.add',compact('types','cates'));
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
        if ($request->hasFile('pic')) {           
            $filename = date('YmdHis').'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);            
            $data['pic']  = '/storage/pic/'.$filename; 
        } 
        $flag = DiancanProduct::create($data);
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
        $where['shop_id'] = session('dcadmin')->shop_id;
        $types = DiancanType::get();
        $cates = DiancanProductCate::where($where)->get();
        $data  = DiancanProduct::find($id);
        //dd($data);
        return view('dingcan.product.edit',compact('types','cates','data'));
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
        if ($request->hasFile('pic')) {           
            $filename = date('YmdHis').'.'.$request->pic->extension();
            $request->pic->storeAs('public/pic',$filename);            
            $data['pic']  = '/storage/pic/'.$filename; 
        } 
        DiancanProduct::where(['id'=>$id])->update($data);
        $rs['status'] = true;
        $rs['msg']    = '操作成功';
        return redirect('diancan/shop/products')->with('rs',$rs);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiancanProduct::destroy($id);
        return back();
    }

    public function repeat($id)
    {
        $where['shop_id'] = session('dcadmin')->shop_id;
        $product    = DiancanProduct::find($id)->toArray();
        $newProduct = array_except($product,['id','created_at','updated_at']);
        $data  = DiancanProduct::create($newProduct);
        $types = DiancanType::get();
        $cates = DiancanProductCate::where($where)->get();
        return view('dingcan.product.edit',compact('types','cates','data'));

    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;        
        $product         = DiancanProduct::find($id);
        $product->status = $request->status;
        $product->save();
        return back();

    }
}
