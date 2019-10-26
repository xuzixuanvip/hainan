<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiancanType extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
    	return $this->hasMany(DiancanProduct::class,'type_id');
    }
}
