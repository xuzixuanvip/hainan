<?php

namespace App\Http\Controllers\Dz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DzController extends Controller
{
    public function index()
    {
        return view('daozhen.index');
    }
}
