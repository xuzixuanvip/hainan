<?php

namespace App\Repos;

use App\Models\Employee;
use App\Models\Position;

class PositionRepo 
{
    
	/**
	 * 删除岗位
	 */
    public static function delete($position_id)
    {
    	// 先看看岗位下有没有员工 有员工不能删除
    	$num = Employee::where('position_id',$id)->count();
    	if($num>0) {
    		return false;
    	}
    	return Position::where('id',$position_id)->delete();
    }
}
