<?php
namespace App\Http\Traits;

/**
* 
*/
Trait Status 
{
	
	public static function taskStatus(){
		$taskStatus = [
						
						'-1'  =>['txt'=>'已取消','style'=>'warning'],
						'0' =>['txt'=>'已退单','style'=>'danger'],
						'1'  =>['txt'=>'待处理','style'=>'warning'],
						'50' =>['txt'=>'处理中','style'=>'success'],
						'75' =>['txt'=>'已报价','style'=>'success'],
						'90' =>['txt'=>'已完工','style'=>'success'],
						'100'=>['txt'=>'已完成','style'=>'primary'],
						'200'=>['txt'=>'已评价','style'=>'primary'],
					];
		return $taskStatus;
	} 
	
}

?>