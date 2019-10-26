<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Emergency;


class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $list   = Emergency::paginate(10);
       
        return view('admin.emergency.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emergency.add');
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
        $flag = Emergency::create($data);
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/emergency');
        }
        return back()->with('rs',$rs)->withInput();
      
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
        $data = Emergency::find($id);
      
        return view('admin.emergency.edit',compact('data'));
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
        $data = $request->except('_token','_method','remark');   

        $flag   = Emergency::where('id',$id)->update($data);

       

        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/emergency');
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
        $rs = Emergency::destroy($id);
        if ($rs) {
            return redirect('zadmin/emergency');
        }
        return back();
    }

    

    
}
