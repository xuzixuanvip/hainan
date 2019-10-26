<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];

    public function subMessage()
    {
    	return $this->hasMany(Message::class,'pid');
    }
}
