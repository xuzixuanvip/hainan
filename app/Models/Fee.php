<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $guarded = ['id'];

    public function yezhu()
    {
    	return $this->belongsTo(Yezhu::class);
    }

    public function feeType()
    {
    	return $this->belongsTo(FeeType::class);
    }
}
