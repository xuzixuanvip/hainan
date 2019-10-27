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


    public function scopePrentBody($query)
    {
        return $query->select('name','id')->where('pid',0)->get()->pluck('name','id');
    }

    public function scopeFilter($query,Filters $filters)
    {
        return $filters->apply($query);
    }

    public function table($pid = 0)
    {
        if($pid == 0){
            $prent = $this->where('pid',$pid)->paginate(10);
        } else {
            $prent = $this->where('pid',$pid)->get();
        }
        foreach ($prent as $k => $v) {
            $prent[$k]['son'] = $this->table($v->id);
        }
        return $prent;
    }


}
