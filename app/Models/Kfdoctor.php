<?php

namespace App\Models;

use App\Filters\DoctorFilters;
use Illuminate\Database\Eloquent\Model;

class Kfdoctor extends Model
{
    //
    public $table  = 'kf_dockor';
    public $timestamps = false;

    protected $fillable = ['name','content','remark','image','title'];


    /**
     * @param $query
     * @param QueryFilter $filters
     * @return mixed
     */
    public function scopeFilter($query, DoctorFilters $filters)
    {
        return $filters->apply($query);
    }

    public function department()
    {
        return $this->belongsToMany('App\Models\Kfdepartment', 'kf_doctor_department', 'doctor_id', 'department_id');
    }

}
