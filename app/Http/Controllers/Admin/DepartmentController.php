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
        $dep =  $department->Filter($filters)->paginate(10);
        return view('admin.department.index',compact('dep'));
    }


    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request,Kfdepartment $department)
    {
        $department->fill($request->except('_token'));
        $department->save();

        return $this->redirect_msg($department,route('department.index'),'添加');
    }

    public function edit(Kfdepartment $department)
    {
        return view('admin.department.edit',compact('department'));
    }


    public function update(Request $request,Kfdepartment $department)
    {
        $department->update($request->except('_token','method'));

        return $this->redirect_msg($department,route('department.index'),'修改');

    }

    public function delete(Request $request,Kfdepartment $department)
    {
        \DB::table('diseases_department')->where('department_id',$request->id)->delete();
        $department->find($request->id)->delete();

        return $this->json_msg($department,'修改');


    }
}
