<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiancanShopUser extends Model
{
    protected $guarded = ['id'];

    public function shop()
    {
    	return $this->belongsTo(DiancanShop::class,'shop_id','id');
    }
}
