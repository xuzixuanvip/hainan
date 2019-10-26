<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $num  = 20;
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

        

        return view('admin.diancanorder.user-index',compact('list','shops','param','departs','start','total'));
    }

   
}
