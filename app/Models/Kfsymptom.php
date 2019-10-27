<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kfsymptom extends Model
{
    protected $table = 'kf_symptom';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
