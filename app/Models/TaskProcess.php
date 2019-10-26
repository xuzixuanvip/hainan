<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskProcess extends Model
{
    protected $table = 'task_process';
    protected $guarded = ['id'];

    public function worker()
    {
    	return $this->belongsTo(User::class,'worker_id','id');
    }

    public function task()
    {
    	return $this->belongsTo(Task::class);
    }

    
}
