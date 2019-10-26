<?php

namespace App\Repos;

use App\Models\Depart;

class DepartRepo 
{
    public static function get($where=[])
    {
    	return Depart::where($where)->select('id','name')->get();
    }
}
