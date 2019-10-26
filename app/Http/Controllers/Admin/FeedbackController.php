<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
    	$list = Feedback::paginate(20);
    	return view('admin.feedback.index',compact('list'));
    }

    public function del($id)
    {
    	$rs['status'] = 'danger';
    	$flag = Feedback::destroy($id);
    	if($flag) {
    		$rs['status'] = 'success';
    		$rs['msg']    = '删除成功';
    		return back()->with('rs',$rs);
    	}
    	$rs['msg'] = '删除失败';
    	return back()->with('rs',$rs);
    }
}
