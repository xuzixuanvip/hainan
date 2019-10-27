<?php

namespace App\Http\Controllers\Admin;

use DemeterChain\B;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Body;

class BodyController extends Controller
{
    //
    public function index(Body $body)
    {
        $body = $body->table();
        return view('admin.body.index',compact('body'));
    }





}
