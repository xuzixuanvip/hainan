<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public function supply()
    {
    	return $this->belongsTo(Supply::class,'supplier_id');
    }
}
