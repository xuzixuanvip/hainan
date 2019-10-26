<?php

namespace App\Repos;

use App\Models\Message;

class MessageRepo 
{
    public static function pages($where=[],$num=10)
    {
    	return Message::where($where)
                        ->orderBy('created_at','desc')
                        ->paginate($num);
    }

    public static function save($data)
    {
    	return Message::create($data);
    }

    public static function find($where=[])
    {
    	return Message::where($where)->first();
    }

    public static function destroy($id)
    {
        return Message::destroy($id);
    }
}
