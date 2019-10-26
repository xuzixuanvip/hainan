<?php

namespace App\Repos;

use App\Models\Depart;
use App\Models\DiancanProduct;
use App\Models\DiancanOrder;
use App\Models\DiancanUser;
use App\Models\DiancanCart;

class DiancanUserRepo 
{
    public  static function checkMoney($user_id,$product_id)
    {

        $rs['status'] = true;
        // 查询今天已下单额度
        $today_money = DiancanOrder::where(['user_id'=>$user_id])->whereDate('created_at',date('Y-m-d'))->sum('total_price');

        // 本次商品的价格
        $product = DiancanProduct::where(['id'=>$product_id])
                                 ->first();
        // 购物车总量                         
        $cart_total = DiancanCart::where(['user_id'=>$user_id])->sum('subtotal');
                                 
        $user_money = DiancanUser::where('id',$user_id)->value('money');   
        //dd($today_money+$product->price+$cart_total,$user_money);              	        
        if($cart_total>$user_money) {
            $rs['status'] = false;
            $rs['msg'] = '余额不足- -！当前余额：'.$user_money;
            return $rs;
        } 

        return $rs;   
    }
}
