<?php

namespace App\Models;

use App\Models\Traits\BodyAttribute;
use Illuminate\Database\Eloquent\Model;
use App\Filters\Filters;


class Body extends Model
{

    use BodyAttribute;

    //
    protected $table = 'bodys';

    protected $fillable = ['name', 'sex','pid'];


    public function table($pid = 0)
    {
        if($pid == 0){
            $prent = $this->where('pid',$pid)->paginate(5);
        } else {
            $prent = $this->where('pid',$pid)->get();
        }
        foreach ($prent as $k => $v) {
            $prent[$k]['son'] = $this->table($v->id);
        }
        return $prent;
    }

    public function delete_All($ids)
    {
        $prent = $this->whereIn('id',$ids)->delete();
        $son = $this->whereIn('pid',$ids)->delete();
        if($prent){
            return response()->json(['code'=>200])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['code'=>400])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }





}
