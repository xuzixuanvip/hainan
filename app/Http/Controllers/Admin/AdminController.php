<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Admin::paginate(20);
        return view('admin.admin.index',compact('list'));
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
        $rs['status'] = false;
        if (!$request->password || ($request->password != $request->password2) ) {
            $rs['msg'] = '请输入密码并且密码要和确认密码必须相同';
            return back()->with('rs',$rs);
        }

        $admin = Admin::where('username',$request->username)->first();
        if($admin) {
            $rs['msg'] = '账号已存在';
            return back()->with($rs);
        }
        $salt   = str_random(40);
        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password =  md5(trim($request->password).$salt);
        $admin->salt = $salt;
        $flag = $admin->save();
        if($flag) {
           $rs['msg'] = '操作成功';
           return redirect('zadmin/admins')->with('rs',$rs);
        }
        $rs['msg'] = '操作失败';
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
        $data = Admin::find($id);
        //dd($data);
        return view('admin.admin.edit',compact('data'));
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
        $rs['status'] = false;
        if ($request->password && ($request->password != $request->password2) ) {
            $rs['msg'] = '密码和确认密码必须相同';
            return back()->with('rs',$rs);
        }
        $admin = Admin::find($id);

        $admin->password = md5(trim($request->password).$admin->salt);
        $flag = $admin->save();
        if($flag) {
           $rs['msg'] = '操作成功';
           return redirect('zadmin/admins')->with('rs',$rs);
        }
        $rs['msg'] = '操作失败';
        return back()->with('rs',$rs);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs['status'] = 'danger';
        $flag         = Admin::destroy($id);
        if ($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '删除成功';
            return redirect('zadmin/admins')->with('rs',$rs); 
        }
        return back()->with('rs',$rs);
    }
}
