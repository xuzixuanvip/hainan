<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanNotice;


class DiancanNoticeController extends Controller
{
    

    public function index(Request $request)
    {
       
        
        $list  = DiancanNotice::paginate(10);
        return view('admin.diancannotice.index',compact('list'));
    }

    public function edit($id)
    {      
        
        $data  = DiancanNotice::find($id);
        return view('admin.diancannotice.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        $id   = (int)$request->id;
        DiancanNotice::updateOrCreate(['id'=>$id],$data);
        $rs['status'] = true;
        $rs['msg']    = '操作成功';
        return redirect('zadmin/diancan/notice')->with('rs',$rs);

    }

    
}
