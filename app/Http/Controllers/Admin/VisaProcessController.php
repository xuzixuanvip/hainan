<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VisaProcess;

class VisaProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weight =VisaProcess::max('weight');
        $list = VisaProcess::paginate(10);
        return view('admin.visa.process.index',compact('list','weight'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rs['status'] = 'warning';
        $rs['msg']    = '操作失败';
        $data = $request->except(['_token']);
        $flag = VisaProcess::create($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/visa/process')->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = VisaProcess::find($id);
        return view('admin.visa.process.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rs['status'] = 'warning';
        $rs['msg']    = '操作失败';
        $data = $request->except('_token','_method');        
        $flag   = VisaProcess::where('id',$id)->update($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/visa/process');
        }
        return back()->with('rs',$rs)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $rs = VisaProcess::destroy($id);
        if ($rs) {
            return redirect('zadmin/visa/process');
        }
        return back();
    }
}
