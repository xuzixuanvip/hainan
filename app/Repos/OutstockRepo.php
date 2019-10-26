<?php

namespace App\Repos;

use App\Models\Outstock;
use App\Models\OutstockGoods;
use App\Models\Goods;
use App\Models\GoodsLog;
use DB;

class OutstockRepo 
{
    public static function pages($where=[],$num=10)
    {
    	return Outstock::where($where)->paginate($num);
    }

    public static function find($where=[])
    {
    	return Outstock::where($where)->first();
    }

    public static function store($data)
    {
    	$rs['status'] = false;
    	$outstock = array_only($data,['code','room_id','name','phone','outed_at','remark']);
        //dd($outstock);
    	DB::beginTransaction();
    	try {
            
    		$flag = Outstock::create($outstock);
	    	if($data['goods_id']) {
	    		foreach ($data['goods_id'] as $k => $v) {
                    $depart['outstock_id'] = $flag->id;
	    			$depart['goods_id']   = $v;
	    			$depart['goods_num']         = $data['goods_num'][$k];
                   // $depart['price']       = $data['goods_price'][$k];
                    //$depart['sub_total'] = $depart['price']*$depart['num'];
	    			OutstockGoods::create($depart);
                    //减少配件库存数量
                    $d = Goods::find($depart['goods_id']);
                    $d->store_num -=$depart['goods_num'];
                    $d->save();

                   // 配件记录
                   $log['goods_id']  = $depart['goods_id'];
                   $log['num']       = $depart['goods_num'];
                   $log['type']      = 3;
                   $log['remark']    = '出库单 '.$flag->code.'出库：'.$d->name.$depart['goods_num'].$d->unit.' ,申请人：'.$outstock['name'].',备注：'.$outstock['remark'];
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
        return Outstock::destroy($id);
    }

    public static function delGoods($id)
    {
        return OutstockGoods::destroy($id);
    }

    public static function updateGoods($data)
    {
        $price = array_pull($data,'goods_price',0);
        $data['subtotal_money'] = $data['goods_num']*$price;
        return OutstockGoods::where('id',$data['id'])->update($data);
    }

    public static function saveGoods($data)
    {
        $og = OutstockGoods::create($data);
        $d = $og->outstock;
        // 配件记录
        $log['goods_id']  = $data['goods_id'];
        $log['num']       = $data['goods_num'];
        $log['type']      = 3;
        $log['remark']    = '出库单 '.$d->code.'出库：'.$d->name.$data['goods_num'].$d->unit;
        GoodsLog::create($log);
    }
}
