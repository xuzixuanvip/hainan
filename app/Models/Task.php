<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function replies()
    {
        return $this->hasMany(TaskReply::class);
    }

    public function depart()
    {
        return $this->belongsTo(Depart::class);
    }

    public function comment()
    {
        return $this->hasOne(TaskComment::class);
    }

    public function getWorkersAttribute()
    {
        $user_ids = TaskProcess::where('task_id',$this->id)->pluck('worker_id');
        if($user_ids) {
            $truenames = User::whereIn('id',$user_ids)->pluck('truename')->toArray();
            return implode(',', $truenames);    
        }
        return '';
        

    }

    public function process()
    {
        return $this->hasMany(TaskProcess::class);
    }


}
