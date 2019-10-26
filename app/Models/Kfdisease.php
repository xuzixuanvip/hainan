<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kfdisease extends Model
{
    protected $table = 'kf_diseases';
    protected $guarded = ['id'];
    public $timestamps = false;
}
