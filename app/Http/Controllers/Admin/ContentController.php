<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = \DB::table('kf_content')->first();
        return view('admin.content.index',compact('content'));
    }


    public function edit($id)
    {
        $content = \DB::table('kf_content')->where('id',$id)->first();
        return view('admin.content.edit',compact('content'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = \DB::table('kf_content')->where('id',$id)->update($request->except('_token'));
        if($data){
            return redirect()->route('content.index')->with('success','成功');
        } else {
            return back()->withErrors(['失败']);
        }
    }

}

