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
        return $this->belongsToMany('App\Models\Kfsymptom','kf_symptom_diseases','diseases_id','symptom_id')->withPivot('probability');
    }


    public function department()
    {
        return $this->belongsToMany('App\Models\Kfdepartment','kf_diseases_department','department_id','diseases_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Kftags','kf_tag_diseases','did','tid');
    }
}
