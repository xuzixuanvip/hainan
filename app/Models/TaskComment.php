<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = 'task_comments';
    protected $guarded = ['id'];
}
