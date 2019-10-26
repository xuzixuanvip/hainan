<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiancanProductCate extends Model
{
    protected $guarded = ['id'];

    public function products()
    {
    	return $this->hasMany(DiancanProduct::class,'cate_id');
    }
}
