<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\Common;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,Common;
    const DEPART_MANAGER = '100';
    const EMPLOYEE       = '1'; // 业务人员

    const COMPLETED_STATUS = 100;
    const PROCESS_STATUS   = 50;
    const WAIT_STATUS   = 1;

    

   
}
