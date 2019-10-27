<?php

namespace App\Models\Traits;

trait BodyAttribute
{

    public function getSexAttribute($value)
    {
        $status = ['0'=>'不限','1'=>'男','2'=>'女'];

        return $status[$value];

    }




}