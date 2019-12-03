<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kfsymptom extends Model
{
    protected $table = 'kf_symptom';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];


    public function symptom_disease()
    {
        return $this->belongsToMany('App\Models\Kfdisease','kf_symptom_diseases','symptom_id','diseases_id')->withPivot('probability');
    }

    public function body_symptom()
    {
        return $this->belongsToMany('App\Models\Kfbody','kf_body_symptom','body_id','symptom_id');
    }

    public function body()
    {
        return $this->belongsToMany('App\Models\body','kf_body_symptom','symptom_id','body_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Kftags','kf_tag_symptom','tag_id','symptom_id');
    }

}
