<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repos\RoleRepo;
use App\Repos\DepartRepo;
use App\Services\Wechat;
use App\Models\Worktype;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function index()
    {
        $where = [];
        if( session('admin')->role_id== self::DEPART_MANAGER ) {
            //$where['depart_id'] = session('admin')->depart_id;
        }
        $list    = User::where($where)->paginate(15);
        $roles   = RoleRepo::getRoles();
        $departs = DepartRepo::get();
        $worktypes = Worktype::get();
        return view('admin.user.index',compact('list','departs','roles','worktypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = RoleRepo::getRoles();
        return view('admin.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token','password2']);
        $salt = $string = str_random(40);
        $data['password'] = md5($data['password'].$salt);
        $data['salt']     = $salt;  
        if( session('admin')->role_id== self::DEPART_MANAGER ) {
            $data['role_id'] =  self::EMPLOYEE;
            $data['depart_id'] = session('admin')->depart_id;
        }
        $flag = User::create($data);
        if($flag) {
            return redirect('zadmin/users');
        }
        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = User::find($id);
        $roles   = RoleRepo::getRoles();
        $departs = DepartRepo::get();
        return view('admin.user.edit',compact('data','roles','departs'));
    }

     public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method','password2','password');
        if($request->password){
            $salt = str_random(40);
            $data['password'] = md5($request->password.$salt);
            $data['salt']     = $salt; 
        }
        
        $rs   = User::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/users');
        }
        return back()->withInput();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs = User::destroy($id);
        if ($rs) {
            return redirect('zadmin/users');
        }
        return back();
    }

  
}
