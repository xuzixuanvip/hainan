<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanOrder;
use App\Models\DiancanShop;
use App\Models\Depart;
use App\Exports\DiancanOrderExport;
use Maatwebsite\Excel\Facades\Excel;

class DiancanOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = $param = [];
        $page = $request->page? :1;
        $num  = 50;
        $start = $page>1?(($page-1)*$num+1):1;
        $query = DiancanOrder::with('shop');
        
        if($request->keyword) {
            $keyword = trim($request->keyword);
            $query->whereHas('user',function($query) use($keyword) {
                $query->where('name','like','%'.$keyword.'%')
                ->orWhere('mobile','like','%'.$keyword.'%');
            });
            $param['keyword'] = $request->keyword;
        }

        if($request->total_price) {
            $total_price = $request->total_price;
            $query->where('total_price','>=',$total_price);
            $param['total_price'] = $total_price;
        }

        if($request->user_id) {
            $query->where('user_id',$request->user_id);
            $param['user_id'] = $request->user_id;
        }
        
        if($request->shop_id) {
            $query->where('shop_id',$request->shop_id);
            $param['shop_id'] = $request->shop_id;
        }

        if($request->depart) {
            $depart = $request->depart;
            $query->whereHas('user',function($query) use ($depart){
                $query->where('department',$depart);
            });
            $param['depart'] = $depart;
        }

        if($request->product_num) {
            $product_num = $request->product_num;
            $query->whereHas('product',function($query) use ($product_num){
                $query->where('product_num','>=',$product_num);
            });
            $param['product_num'] = $product_num;
        }

        if($request->beginDate) {
            $from = $request->beginDate;
            $to   = $request->endDate;
            $param['beginDate'] = $from;
            $param['endDate'] = $to;
            $query->whereDate('created_at','>=',$from);
            $query->whereDate('created_at','<=',$to);
        }
        $departs = Depart::all();
        $shops = DiancanShop::get();
        $totalQuery = $query;
        $total = $totalQuery->get();
        $list  = $query->orderBy('created_at','desc')
                                ->paginate($num);

        

        return view('admin.diancanorder.index',compact('list','shops','param','departs','start','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DiancanOrder::find($id);
        return view('admin.diancanorder.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DiancanOrder::find($id);
        return view('admin.diancanorder.edit',compact('data'));
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
        //
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

    //导出工单。
    public function orderExport(Request $request)
    {
        $param = $request->all();
       
        
        return Excel::download(new DiancanOrderExport($param), '点餐订单统计.xlsx');   
    }
}
