<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Depart;

class DepartController extends Controller
{
    public function index(Request $request)
    {
    	$rs['status'] = false;
        $where = [];
        if($request->id){
            $pid = $request->id;
            $where['pid'] = $pid;    
        }
        
    	$fields = ['id','name'];        
    	$list   = Depart::where($where)
                        ->select($fields)
                        ->get();

    	if(count($list)) {
    		$rs['status'] = true;
    		$rs['data']   = $list;
    		return response()->json($rs);
    	}
    	return response()->json($rs);
    }
}
