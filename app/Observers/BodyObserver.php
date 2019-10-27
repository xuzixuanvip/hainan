<?php

namespace App\Observers;

use App\Models\Body;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BodyObserver
{
    public function creating(Body $body)
    {
        //
    }

    public function created(Body $body)
    {

    }

    public function updating(Body $body)
    {

    }

    // 保存之前
    public function saving(Body $body)
    {

    }


    public function deleted(Body $body)
    {
        \DB::table('bodys')->whereIn('pid',array($body->id))->delete();
    }
}