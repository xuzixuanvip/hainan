<?php
namespace App\Exports;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TaskExport implements FromView
{
    private $where;
    public function __construct($where)
    {
        $this->where = $where;
    }

    public function view(): View
    {
        $param = $this->where;
        $query = Task::query();
        //dd($param);
        if(array_get($param,'depart_id')){
            $query->where('depart_id',$param['depart_id']);
        }

        if(array_get($param,'category_id')){
            $query->where('category_id',$param['category_id']);
        }
        
        if(array_get($param,'money')==1){
            $query->where('money','>',0);
        }

        if(array_get($param,'beginDate')) {
            $begin = array_pull($param,'beginDate').' 0:0:0';
            $end   = array_pull($param,'endDate').' 23:59:59';  

            $query->whereBetween('created_at', [$begin,$end]);
            
        }

        if (array_get($param,'keyword')) {
            $keyword = array_pull($param,'keyword');
            $query->where(function($query) use ($keyword) {
                $query->where('mobile','like','%'.$keyword.'%')
                      ->orWhere('customer_name','like','%'.$keyword.'%')
                      ->orWhere('content','like','%'.$keyword.'%')
                      ->orWhere('remark','like','%'.$keyword.'%');
            });
        }

        $list = $query->get();            
       
        return view('admin.task.export_index', [
            'list' => $list
        ]);
    }
}

?>