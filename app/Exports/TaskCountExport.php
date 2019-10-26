<?php
namespace App\Exports;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TaskCountExport implements FromView
{
    private $where;
    public function __construct($where)
    {
        $this->where = $where;
    }

    public function view(): View
    {
        $query = User::where(['role_id'=>1]);
        if(isset($this->where['truename'])) {
            $query->where('truename','like','%'.$this->where['truename'].'%');
        }
        $list = $query->get();
        //dd($list);
        foreach ($list as $key => $worker) {
            $map['worker_id'] = $worker->id;
            $query = Task::query();
            if(isset($this->where['beginDate'])) {
                $query->whereBetween('created_at',[$this->where['beginDate'],$this->where['endDate']]);   
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
        return view('admin.census.index', [
            'list' => $list
        ]);
    }
}

?>