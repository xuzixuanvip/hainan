<?php

namespace App\Repos;

use App\Models\Role;

class RoleRepo 
{
    public static function getRoles()
    {
    	return Role::select('id','code','name')->get();
    }
}
