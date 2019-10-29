<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kftags extends Model
{
    protected $table = 'kf_tags';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    public function tags()
    {
        return $this->belongsToMany('App\Models\kftags','tags_symptom','tags_id','symptom_id');
    }
}
