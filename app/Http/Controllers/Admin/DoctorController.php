<?php

namespace App\Http\Controllers\Admin;

use App\Filters\DoctorFilters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kfdoctor;
use App\Models\Kfdepartment;
use App\Helpers\ImageUploadHandlers;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorFilters $filters)
    {
        $doctor =  Kfdoctor::filter($filters)->paginate(20);
        $department = Kfdepartment::get();
        return view('admin.doctor.index',compact('doctor','department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department = Kfdepartment::get();
        return view('admin.doctor.add',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kfdoctor $doctor)
    {
        if(!$request->hasFile('img')) return back()->withErrors(['请上传图片']);
        $img = app(ImageUploadHandlers::class)->save2($request->img,'doctor');
        $request->offsetSet('image',$img['msg']);
        $doctor_data = $doctor->create($request->except('_token', 'department'));
        $doctor_data->department()->attach($request->department);

        if($doctor_data) {
            return redirect()->route('doctor.index')->with(['success'=>'添加成功']);
        } else {
            return back()->withErrors(['添加失败']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kfdoctor $doctor)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kfdoctor $doctor)
    {
        //
        $department = Kfdepartment::get();
        $department_id = $doctor->department->pluck('id')->all();
        return view('admin.doctor.edit',compact('doctor','department','department_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kfdoctor $doctor)
    {
        if($request->hasFile('img')){
            $image = app(ImageUploadHandlers::class)->save2($request->img,'doctor');
            $request->offsetSet('image',$image['msg']);
        }
        $doctor->update($request->except('_token','_method','department'));
        $msg = $doctor->department()->sync($request->department);
        if($msg) {
            return redirect()->route('doctor.index')->with(['success'=>'修改成功']);
        } else {
            return back()->withErrors(['失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Kfdoctor $doctor)
    {
//        dd($request->id);
        $doctor_data = $doctor->find($request->id);
        $msg = $doctor_data->delete();
        $doctor_data->department()->detach();
//        $request->id
        if($msg) {
            $data = ['code'=>200,'msg'=>'删除成功'];
        } else {
            $data = ['code'=>400,'msg'=>'删除失败'];
        }
        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);

    }
}
