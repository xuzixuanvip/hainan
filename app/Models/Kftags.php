<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kftags extends Model
{
    protected $table = 'kf_tags';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = ['name', 'status','image'];

    public function tags_count()
    {
        return $this->belongsToMany('App\Models\Kfsymptom','kf_tag_symptom','symptom_id','tag_id');
    }

}
