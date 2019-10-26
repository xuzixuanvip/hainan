<?php
namespace App\Http\Controllers\DcApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanShop;
use App\Models\DiancanProduct;
use App\Models\DiancanProductCate;
use App\Models\DiancanType;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rs['status']     = true;
        $where['status']  = 1;
        $where['shop_id'] = $request->shop_id;
        if($request->cate_id) {
            $where['cate_id'] = (int)$request->cate_id;
        }
        if($request->type_id) {
            $where['type_id'] = (int)$request->type_id;
        }

        $list = DiancanProduct::where($where)->get();
        $shop = DiancanShop::find($request->shop_id);
        $rs['data'] = $list;
        $rs['shop'] = $shop;
        return response()->json($rs);

    }

    public function cate(Request $request)
    {
        $rs['status']     = true;
        $where['shop_id'] = $request->shop_id;
        $list = DiancanProductCate::where($where)
                                    ->select(['id','name'])
                                    ->get();
        $rs['data'] = $list;
        return response()->json($rs);
    }

    public function type(Request $request)
    {
        $rs['status']  = true; 
        $where = [];       
        $list = DiancanType::where($where)
                                    ->select(['id','name'])
                                    ->get();
        $rs['data'] = $list;
        return response()->json($rs);
    }

    
}
