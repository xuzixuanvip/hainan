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


    protected $fillable = ['name', 'sex','href'];

    public function diseases()
    {
        return $this->belongsToMany('App\Models\Kfdisease','kf_diseases_department','department_id','diseases_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Kftags','kf_tag_department','did','tid');
    }


    /**
     * @param $query
     * @param Filters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, Filters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @return mixed
     */
    public function doctor()
    {
        return $this->belongsToMany('App\Models\Kfdoctor', 'kf_doctor_department', 'department_id','doctor_id');
    }

}
