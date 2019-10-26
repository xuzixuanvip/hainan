<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Worklog;

class WorklogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Worklog::paginate(20);
        return view('admin.worklog.index',compact('list'));
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
        if(object_get($request,'pic')){
                $extension = $request->pic->extension();
                $filename = date('Ymdhis').'.'.$extension;
                $request->pic->storeAs('public/worklog',$filename);
                $data['pic']  = '/storage/worklog/'.$filename; 
        } 
       
        $rs   = Worklog::create($data);
        if($rs) { 
           
            return redirect('zadmin/worklog');
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
        $data = Worklog::find($id);        
        return view('admin.worklog.edit',compact('data'));
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
       
        $rs   = Worklog::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/worklog');
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
        $rs = Worklog::destroy($id);
        if ($rs) {
            return redirect('zadmin/worklog');
        }
        return back();
    }
}
