<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellerMoneyLog;
use App\Models\TaskMoneyLog;

class LogController extends Controller
{
    /**
     * 财务日志
     */
    public function moneyLog(Request $request)
    {
    	$param = [];
    	if($request->type){
    		$param['type'] = $where['type'] = $request->type;

    	}
    	$where['seller_id'] = session('seller')->id;
    	$list = SellerMoneyLog::where($where)->paginate(20);
    	return view('hrs.log.sellermoneylog',compact('list','param'));
    }

    /**
     * 佣金流水
     */
    public function taskMoneyLog(Request $request) 
    {
    	$param = [];
    	$where['seller_id'] = session('seller')->id;
    	$list = TaskMoneyLog::where($where)->paginate(20);
    	return view('hrs.log.taskmoneylog',compact('list','param'));
    }
}
