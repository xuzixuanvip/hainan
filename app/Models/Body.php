<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    //
    protected $table = 'bodys';





    public function table($pid = 0)
    {
        $prent = $this->where('pid',$pid)->paginate(10);
        foreach ($prent as $k => $v) {
            $prent[$k]['son'] = $this->table($v->id);
        }
        return $prent;
    }
}
