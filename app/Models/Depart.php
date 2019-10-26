<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    protected $guarded = ['id'];

    public function childs()
    {
    	return $this->hasMany(Depart::class,'pid','id');
    }
}
