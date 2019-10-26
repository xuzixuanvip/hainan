<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wxtpl extends Model
{
    protected $guarded = ['id'];

    public function contents()
    {
    	return $this->hasMany(WxtplContent::class);
    }
}
