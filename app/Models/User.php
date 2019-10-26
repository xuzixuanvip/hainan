<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id','code');
    }

    public function depart()
    {
    	return $this->belongsTo(Depart::class);
    }

    public function process()
    {
        return $this->hasMany(TaskProcess::class,'id','worker_id');
    }

    public function worktype()
    {
        return $this->belongsTo(Worktype::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class,'worker_id');
    }
    
}
