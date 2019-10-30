<?php

namespace App\Observers;

use App\Models\kfBody;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class kfBodyObserver
{

    public function deleting(kfBody $body)
    {
        $body->delete_son_id($body->id);
        \DB::table('kf_bodys')->whereIn('pid',array($body->id))->delete();
        \DB::table('body_symptom')->whereIn('body_id',array($body->id))->delete();
    }


    public function deleted(kfBody $body)
    {

    }
}