<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseGoods extends Model
{
    protected $guarded = ['id'];

    public function purchase()
    {
    	return $this->belongsTo(Purchase::class);
    }

    public function goods()
    {
    	return $this->belongsTo(Goods::class,'goods_id');
    }

    
}
