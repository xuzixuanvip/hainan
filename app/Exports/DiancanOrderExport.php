<?php
namespace App\Exports;

use App\Models\DiancanOrder;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiancanOrderExport implements FromView
{
    private $where;
    public function __construct($where)
    {
        $this->where = $where;
    }

    public function view(): View
    {
        $param = $this->where;
        $query = DiancanOrder::query();
        //dd($param);
        
         if(array_get($param,'shop_id')){
            $query->where('shop_id',$param['shop_id']);
        }
       
        

        if(array_get($param,'beginDate')) {
            $begin = array_pull($param,'beginDate').' 0:0:0';
            $end   = array_pull($param,'endDate').' 23:59:59';  

            $query->whereBetween('created_at', [$begin,$end]);
            
        }

        if (array_get($param,'keyword')) {
            $keyword = array_pull($param,'keyword');
            $query->whereHas('user',function($query) use ($keyword) {
                $query->where('mobile','like','%'.$keyword.'%')
                      ->orWhere('name','like','%'.$keyword.'%');                     
            });
        }

        if(array_get($param,'depart')) {
            $depart = array_pull($param,'depart');
            $query->whereHas('user',function($query) use ($depart){
                $query->where('department',$depart);
            });
            $param['depart'] = $depart;
        }

        $list = $query->get();            
       
        return view('admin.diancanorder.export_index', [
            'list' => $list
        ]);
    }
}

?>