<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Exports\TaskExport;
use App\Exports\TaskCountExport;
use Maatwebsite\Excel\Facades\Excel;

class CensusController extends Controller
{
    /**
     * 维修工作量统计
     */
    public function workerCount(Request $request)
    {
    	$param = [];
    	$truename  = '';
    	$beginDate = '';
    	$endDate   = '';
    	
    	if($request->truename) {
    		$param['truename'] = $truename = $request->truename;
    	}
    	
    	if($request->beginDate) {
    		$param['beginDate'] = $beginDate = $request->beginDate;
    		$param['endDate']   = $endDate   = $request->endDate;
    	}



    	$query = User::select(['id','username','truename']);
    	if($truename) {
    		$query->where('truename','like','%'.$truename.'%');
    	}
    	$list = $query->where('role_id',1)
    				 ->paginate(20);

    	foreach ($list as $key => $worker) {
    		$map['worker_id'] = $worker->id;
    		$query = Task::query();
    		if($beginDate) {
    			$query->whereBetween('created_at',[$beginDate,$endDate]);	
    		}
    		
    		$list[$key]['task_num'] = $query->where($map)->count();  		

    		if($list[$key]['task_num'] == 0) {
    			$list[$key]['finish_num'] = $list[$key]['finish_rate'] = 0;
    		} else {
    			
    			$list[$key]['finish_num'] = $query->where('status','>',99)->count();

    			$list[$key]['finish_rate'] = round(($list[$key]['finish_num']/$list[$key]['task_num']*100),2).'%';
    		}

    		$list[$key]['money'] =  $query->sum('money');
    	
    		
    	}
    	  
        return view('admin.census.work_count',compact('list','param'));        
    }

    public function workerCountExport(Request $request)
    {
    	$param = [];
    	$truename  = '';
    	$beginDate = '';
    	$endDate   = '';
    	
    	if($request->truename) {
    		$param['truename'] = $truename = $request->truename;
    	}
    	
    	if($request->beginDate) {
    		$param['beginDate'] = $beginDate = $request->beginDate;
    		$param['endDate']   = $endDate   = $request->endDate;
    	}


		return Excel::download(new TaskCountExport($param), '工作量统计.xlsx');   
    }
}
