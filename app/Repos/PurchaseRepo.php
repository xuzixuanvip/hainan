<?php

namespace App\Repos;

use App\Models\Purchase;
use App\Models\PurchaseGoods;
use App\Models\Goods;
use App\Models\GoodsLog;
use DB;

class PurchaseRepo 
{
    public static function pages($where=[],$num=10)
    {
    	return Purchase::where($where)->paginate($num);
    }

    public static function find($where=[])
    {
    	return Purchase::where($where)->first();
    }

    public static function store($data)
    {
    	$rs['status'] = false;
    	$purch = array_only($data,['code','caigouer','supplier_id','bill_date','remark']);
    	DB::beginTransaction();
    	try {
            $purch['caigou_num'] = array_sum($data['goods_num']);
    		$flag = Purchase::create($purch);
	    	if($data['goods_id']) {
	    		foreach ($data['goods_id'] as $k => $v) {
                    $depart['purchase_id'] = $flag->id;
	    			$depart['goods_id']   = $v;
	    			$depart['num']         = $data['goods_num'][$k];
                    $depart['price']       = $data['goods_price'][$k];
                    $depart['sub_total'] = $depart['price']*$depart['num'];
	    			PurchaseGoods::create($depart);
                    // 增加配件库存数量
                    $d = Goods::find($depart['goods_id']);
                    $d->store_num +=$depart['num'];
                    $d->save();

                   // 配件记录
                   $log['goods_id'] = $depart['goods_id'];
                   $log['num']       = $depart['num'];
                   $log['type']      = 2;
                   $log['remark']    = '采购 '.$d->name.$depart['num'].$d->unit;
                   GoodsLog::create($log); 

	    		}
	    	}
    		
    	} catch (\Exception $e) {
    		DB::rollBack();
    		$rs['msg'] = $e->getMessage();
    		return $rs;
    	}
    	$rs['status'] = true;
    	DB::commit();
    	return $rs;
    }

    public static function destroy($id)
    {
        return Purchase::destroy($id);
    }
}
