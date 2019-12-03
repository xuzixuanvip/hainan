<?php

namespace App\Models\Traits;

use App\Filters\Filters;

trait BodyAttribute
{

    public function getSexAttribute($value)
    {
        $status = ['0'=>'不限','1'=>'男','2'=>'女'];

        return $status[$value];

    }

    public function scopePrentBody($query)
    {
        return $query->select('name','id')->where('pid',0)->get()->pluck('name','id');
    }

    public function scopeFilter($query,Filters $filters)
    {
        return $filters->apply($query);
    }


    public function symptom()
    {
        return $this->belongsToMany('App\Models\Kfsymptom','kf_body_symptom','body_id','symptom_id');
    }

}