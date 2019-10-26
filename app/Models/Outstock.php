<?php
namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Outstock extends Model
{
    protected $guarded = ['id'];

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    public function goods()
    {
    	return $this->hasMany(OutstockGoods::class);
    }

    public function getGoodsNameAttribute()
    {
    	$where['outstock_id'] = $this->id;	
    	$ids = OutstockGoods::where($where)->pluck('goods_id');
    	$names = Goods::whereIn('id',$ids)
    					->pluck('name')->toArray();
    	return implode(',', $names);
    }
}
