<?php

namespace App\Observers;

use App\Models\kfBody;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class kfBodyObserver
{

    public function deleted(kfBody $body)
    {
        \DB::table('kf_bodys')->whereIn('pid',array($body->id))->delete();
    }
}