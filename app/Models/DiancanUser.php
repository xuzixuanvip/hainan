<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiancanUser extends Model
{
    protected $guarded = ['id'];

     protected $appends = ['order_num'];

    public function orders()
    {
    	return $this->hasMany(DiancanOrder::class,'user_id');
    }

    	
    public function getOrderNumAttribute()
    {
    	$num = DiancanOrder::where(['user_id'=>$this->id])
    				->whereMonth('created_at', Carbon::now()->month)
    				->count();
    	return $num;
    }
    
}
