<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TaskReply extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];   

    public function fromUser()
    {
    	return $this->belongsTo(User::class);
    }

    public function toUser()
    {
        return $this->belongsTo(User::class);
    }    

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
