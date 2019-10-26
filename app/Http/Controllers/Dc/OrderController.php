<?php

namespace App\Http\Controllers\Dc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanOrder;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $where = [];

        $where['shop_id'] = session('dcadmin')->shop_id;
        if($request->status) {
            $where['status'] = $request->status;
        }
        $list  = DiancanOrder::where($where)
                                ->orderBy('created_at','desc')
                                ->paginate(10);
        $data['all_money'] = DiancanOrder::where($where)->sum('total_price');
        $data['all_num']   = DiancanOrder::where($where)->count(); 
        $date = date('Y-m-d');
        $data['today_money'] = DiancanOrder::whereDate('created_at',$date)->where($where)->sum('total_price');
        $data['today_num']   = DiancanOrder::whereDate('created_at',$date)->where($where)->count(); 

        $data['month_money'] = DiancanOrder::whereMonth('created_at',date('m'))->where($where)->sum('total_price');
        $data['month_num']   = DiancanOrder::whereMonth('created_at',date('m'))->where($where)->count();



        return view('dingcan.order.index',compact('list','data'));
    }

    public function show(Request $request)
    {
        $where = [];
       // $where['shop_id'] = session('dcadmin')->shop_id;
        $where['code']    = $request->code;
        $data  = DiancanOrder::where($where)->first();
        return view('dingcan.order.show',compact('data'));
    }
}
