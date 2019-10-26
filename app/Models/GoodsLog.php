<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsLog extends Model
{
    protected $guarded = ['id'];

    public function goods()
    {
    	return $this->belongsTo(Goods::class,'goods_id');
    }
}
