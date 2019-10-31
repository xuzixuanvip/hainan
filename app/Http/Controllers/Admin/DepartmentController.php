<?php

namespace App\Http\Controllers\Admin;
use App\Models\Kfdisease;
use App\Models\Kfdepartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Traits\MessageTraits;
use App\Filters\DepartmentFilters;


class DepartmentController extends Controller
{
    public function index(DepartmentFilters $filters,Kfdepartment $department)
    {
        $department->Filter($filters)->paginate(10);
        return view('admin.department.index',compact('department'));
    }


}
