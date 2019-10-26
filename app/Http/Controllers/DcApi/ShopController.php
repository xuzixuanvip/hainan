<?php

namespace App\Http\Controllers\DcApi;

use App\Http\Resources\ShopCollection;
use App\Models\DiancanShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rs['status'] = true;
        $list = DiancanShop::where(['status'=>1])
                            ->orderBy('weight','asc')
                            ->get();
        $rs['data'] = $list;
        return response()->json($rs);

    }

    public function info(Request $request)
    {
        $rs['status'] = true;
        $id   = (int)$request->shop_id;
        $data = DiancanShop::find($id);
        $rs['data'] = $data;
        return response()->json($rs);
    }

    
}
