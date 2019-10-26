<?php
/**
 * User: bzs
 * Date: 2017/7/19
 * Time: 16:23
 */

namespace App\Repos;

use App\Models\Menu;


class MenuRepo
{
	/**
	 * @var 菜单模型
	 */
	public $model;

	/**
	 * AdminRepositories constructor.
	 * @param Node $model
	 */
	function __construct(Menu $model)
	{
		$this->model = $model;
	}

	/**
	 * 递归获取所有菜单
	 * @param collection $collection 菜单集合
	 * @param int $system_id 系统id
	 * @param $parent_id  上级id
	 * @return collection 返回菜单集合
	 */
	function get_menus($collection,$parent_id =0)
	{
	   
	  
	    $where['parent_id'] = $parent_id;
	    $rs = Menu::where($where)->orderBy('parent_id','asc')->get();
	   
	    foreach ($rs as $k => $v) {
	    	$collection->push($v);	    	   	
	    	$has_sub  = $v->subMenu;	    	
	    	if($has_sub->isEmpty()) {		
	    		continue;
	    	} else {	    		
	    		$this->get_menus($collection,$v->id);	
	    	} 
	    }
	    return $collection;
    
	}

	
	//调用递归方法获取菜单（排序） 
    public static function   get_user_menus($menus)
    {

    	$data = Menu::select('id','level', 'parent_id', 'name', 'url', 'icon')
            ->with(['parent' => function ($query) {
                return $query->select('id','level', 'parent_id', 'name', 'url', 'icon');
            }])
            ->whereIn('id', $menus)
            ->orderBy('sort', 'ASC')
            ->get();

        $arr = [];
    	foreach ($data as $k => $menu) {

            if($menu->level==1) {
                $arr[$menu->id] = $menu->toArray();
            } elseif($menu->level==2) {

                $arr[$menu->parent_id]['sub'][$menu->id] = $menu->toArray();
            }elseif($menu->level==3) {


                $arr[$menu->parent->parent_id]['sub'][$menu->parent->id]['sub'][$menu->id] = $menu->toArray();
            }
        }

	       return $arr;
    }
	
}