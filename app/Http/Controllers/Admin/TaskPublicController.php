<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskProcess;
use App\Models\TaskComment;
use App\Models\Depart;
use App\Models\Category;
use App\Repos\TaskRepo;
use App\Services\Wechat;
use App\Exports\TaskExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TaskPublicController extends Controller
{
    public function index(Request $request)
    {
        $where = $param = [];
        $query = Task::query();
        $page = $request->page? :1;
        $num  = 20;
        $start = $page>1?(($page-1)*$num+1):1;
        //dd($page);
        if($request->status) {
            $param['status'] = $where['status'] = (int)$request->status;
        }

        
        if($request->worker_id){
            $param['status'] = $where['worker_id'] = $request->worker_id;
        }

        if($request->depart_id){
            $param['depart_id'] = $where['depart_id'] = $request->depart_id;

        }

        if($request->category_id){
            $param['category_id'] = $where['category_id'] = $request->category_id;

        }

        // if(session('admin')->role_id!=999) {
        //      $where['depart_id'] = session('admin')->depart_id;
        // }
        $query->where($where);

        if ($request->keyword) {
            $keyword = trim($request->keyword);
            $query->where(function($query) use ($keyword) {
                $query->where('mobile','like','%'.$keyword.'%')
                      ->orWhere('customer_name','like','%'.$keyword.'%')
                      ->orWhere('content','like','%'.$keyword.'%')
                      ->orWhere('remark','like','%'.$keyword.'%');
            });
        }

        if($request->money==1) {
            $query->where('money','>',0);
            $param['money'] = $request->money;
        }

        
        $departs = Depart::get();
        $cates   = Category::get();
        $workers = User::where('role_id',1)->get();
    	$list = $query->orderBy('created_at','desc')->paginate(20);

        if($request->price) {
           $list = Task::where('money','>',0)->orderBy('created_at','desc')->paginate($num);
           $param['price'] = 1; 
        }
    	return view('admin.task.public-index',compact('list','param','workers','departs','cates','start'));
    }

    public function show($id)
    {
    	$data = Task::find($id);
        $wechatInfo = json_decode($data->userinfo,true);
        $process = TaskProcess::where('task_id',$id)->get();
        $comment = TaskComment::where('task_id',$id)->first();
    	return view('admin.task.show',compact('wechatInfo','data','process','comment'));
    }

     public function edit($id)
    {
        $data = Task::find($id);
        $wechatInfo = json_decode($data->userinfo,true);
        $process = TaskProcess::where('task_id',$id)->get();
        $comment = TaskComment::where('task_id',$id)->first();
        $departs = Depart::get();
        $cates = Category::get();
        $workers = User::where('role_id',1)->get();
        return view('admin.task.edit',compact('data','departs','cates','wechatInfo','process','comment','workers'));
    }

   
}
