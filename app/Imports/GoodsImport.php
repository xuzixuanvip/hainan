<?php

namespace App\Imports;

use App\Models\Goods;
use App\Models\GoodsCate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        $rows->shift();
        $rows->shift();
        $rows->shift();
       // dd($rows);
        foreach ($rows as $row) 
        {
            if(empty($row[1])) continue;
            //dd($row[3]);
            $cate_name = $row[3];
            $dc = GoodsCate::where('name',$cate_name)->first();
            if(!$dc) continue;

            $GoodsData['name']    = $row[1];     
            $GoodsData['cate_id'] = $dc->id;      
            $Goods = Goods::where($GoodsData)->first();
            if(!$Goods) {
                $GoodsData['source_code'] = $row[0];
                $GoodsData['store_num']   = $row[5];
                $GoodsData['unit']        = $row[6];
                $GoodsData['in_price']    = $row[8];
                $GoodsData['out_price']   = $row[7];
                $GoodsData['remark']      = $row[9];
                $GoodsData['code']  = date('YmdHis').str_random(4);
                $Goods = Goods::create($GoodsData);    
            }
            

            


        }


    }
}
