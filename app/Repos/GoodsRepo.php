<?php

namespace App\Repos;

use App\Models\Goods;
use App\Models\GoodsLog;

class GoodsRepo 
{
    public static function get($where=[])
    {
    	return Goods::where($where)->select('id','name')->get();
    }

    public static function create($data)
    {
    	$rs['status'] = false;
        try {
            $flag   = Goods::create($data);
            // 配件记录
            $log['Goods_id'] = $flag->id;
            $log['num']       = $flag->store_num;
            $log['type']      = 1;
            $log['remark']    = '配件'.$flag->name.'初始数量'.$flag->store_num.$flag->unit;
            GoodsLog::create($log);
        } catch (\Exception $e) {
            $rs['msg'] = $e->getMessage();
            return $rs;
        }
        $rs['status'] = true;
        return $rs;
    }

    public static function updateStore($data,$type=3)
    {
        $rs['status'] = false;
        try {
            $Goods   = Goods::find($data['Goods_id']);
            if($type==3) {
                $Goods->store_num = $Goods->store_num-$data['Goods_num'];     
            }else {
                $Goods->store_num = $Goods->store_num+$data['Goods_num'];
            }
            $Goods->save();
            
            $type_name = $type==3?'减少':'增加';
            // 配件记录
            $log['Goods_id'] = $data['Goods_id'];
            $log['num']       = $data['Goods_num'];
            $log['type']      = $type;
            $log['remark']    = '配件'.$Goods->name.'数量'.$type_name.$data['Goods_num'].$Goods->unit;
            GoodsLog::create($log);
        } catch (\Exception $e) {
            $rs['msg'] = $e->getMessage();
            return $rs;
        }
        $rs['status'] = true;
        return $rs;
    }
}
