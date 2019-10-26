<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Seller;

class IndexController extends Controller
{
    public function index()
    {   //dd(str_random(60));
    	
    	$param = [];
    	$where['user_id'] = session('user')->id;    	
    	$tasks = Task::where($where)->paginate(10);
        return view('hrs.index',compact('tasks','param'));
    }

  
    
}
