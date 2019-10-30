<?php

namespace App\Models;

use App\Models\Traits\BodyAttribute;
use Illuminate\Database\Eloquent\Model;
use App\Filters\Filters;
use phpDocumentor\Reflection\Types\Void_;


class kfBody extends Model
{

    use BodyAttribute;

    //
    protected $table = 'kf_bodys';

    protected $fillable = ['name', 'sex','pid'];

    public $timestamps = false;

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

//    public function delete_All($ids)
//    {
//        $this->delete_son_id($ids);
//        $prent = $this->whereIn('id',$ids)->delete();
//        $son = $this->whereIn('pid',$ids)->delete();
//        if($prent){
//            return response()->json(['code'=>200])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
//        } else {
//            return response()->json(['code'=>400])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
//        }
//    }


    public function delete_son_id($id)
    {
        $prent_id = $this->find($id);
        $son_ids = [];
        $data = $this->whereIn('pid',array($prent_id->id))->get();
        foreach ($data  as $v) {
            $son_ids[] = $v->id;
        }
        \DB::table('body_symptom')->whereIn('body_id',$son_ids)->delete();
    }


}
