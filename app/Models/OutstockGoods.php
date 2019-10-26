<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutstockGoods extends Model
{
    protected $guarded = ['id'];

    public function outstock()
    {
    	return $this->belongsTo(Outstock::class);
    }

    public function goods()
    {
    	return $this->belongsTo(Goods::class);
    }
}
