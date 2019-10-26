<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Worktype;
use App\Models\Worker;
use App\Models\User;
use App\Repos\DepartRepo;

class WorkerController extends Controller
{
    public function index()
    {
        $list      = User::where('role_id',1)->paginate(20);        
        
        return view('admin.worker.index',compact('list','worktypes'));
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
        $data = $request->except('_token');
       
        $rs   = User::create($data);
        if($rs) { 
           
            return redirect('zadmin/worker');
        }
        return back();
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
        $data = User::find($id);
        $worktypes = Worktype::get();
        $departs = DepartRepo::get();
        return view('admin.worker.edit',compact('data','worktypes','departs'));
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
        $data = $request->except('_token','_method');
       
        $rs   = User::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/worker');
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
            return redirect('zadmin/worker');
        }
        return back();
    }
}
