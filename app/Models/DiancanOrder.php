<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class DiancanOrder extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['products','status_txt','status_css'];

    public function shop()
    {
    	return $this->belongsTo(DiancanShop::class,'shop_id');
    }

    public function product()
    {
        return $this->hasMany(DiancanOrderProduct::class,'order_id');
    }

    public function getProductsAttribute()
    {
    	$list = DB::table('diancan_order_products as op')
    	->select(['op.id','op.product_num','op.product_price','op.subtotal','p.name','p.pic'])
    	->leftJoin('diancan_products as p','p.id','=','op.product_id')
    	->where('op.order_id',$this->id)
    	->get();
    	return $list;
    }

    public function getStatusTxtAttribute()
    {
        $arr['-1']   = '已取消';
        $arr['1']    = '待配送';
        $arr['100']  = '已完成';
        return $arr[$this->status];
    }

    public function getStatusCssAttribute()
    {
        $arr['-1']   = 'warning';
        $arr['1']    = 'danger';
        $arr['100']  = 'success';
        return $arr[$this->status];
    }

    public function user()
    {
        return $this->belongsTo(DiancanUser::class,'user_id');
    }
}
