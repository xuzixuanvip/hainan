<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Wechat;

class WxMenuController extends Controller
{
    public function index()
    {    	
		$list = Wechat::getMenu();
        
    	return view('admin.wxmenu.index',compact('list'));
    }

    public function show($tpl_key)
    {
    	//$tpls = Wechat::getMsgtpl();
    	//$data = $tpls[$tpl_key];
    	//dd($data);
    	//return response()->json($data);
    	// return view('admin.msgtpl.show');
    }
}
