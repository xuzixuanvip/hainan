<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kfdisease extends Model
{
    protected $table = 'kf_diseases';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = ['name', 'introduction','sex','cate_id','treatment','cause','clinical','concomitant'];

    public function symptom_disease()
    {
        return $this->belongsToMany('App\Models\Kfsymptom','symptom_diseases','diseases_id','symptom_id');
    }

    public function department()
    {
        return $this->belongsToMany('App\Models\kfdepartment','diseases_department','diseases_id','department_id');
    }

}
