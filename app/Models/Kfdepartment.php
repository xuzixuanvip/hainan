<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filters;


class Kfdepartment extends Model
{
    protected $table = 'kf_department';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function diseases()
    {
        return $this->belongsToMany('App\Models\kfdiseases','diseases_department','department_id','diseases_id');
    }


    public function scopeFilter($query,Filters $filters)
    {
        return $filters->apply($query);
    }


}
