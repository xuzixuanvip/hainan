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
        return $this->belongsToMany('App\Models\Kfsymptom','symptom_diseases','diseases_id','symptom_id');
    }

    public function body_symptom()
    {
        return $this->belongsToMany('App\Models\Kfbody','body_symptom','body_id','symptom_id');
    }

    public function body()
    {
        return $this->belongsToMany('App\Models\body','body_symptom','symptom_id','body_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Kftags','tags_diseases','tags_id','symptom_id');
    }
}
