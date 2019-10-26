<?php

namespace App\Repos;

use App\Models\System;

class SystemRepo 
{
    public static function find()
    {
    	return System::first();
    }
}
