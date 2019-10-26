<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiancanProduct extends Model
{
    protected $guarded = ['id'];

    public function type()
    {
    	return $this->belongsTo(DiancanType::class,'type_id');
    }

    public function cate()
    {
    	return $this->belongsTo(DiancanProductCate::class,'cate_id');
    }


}
