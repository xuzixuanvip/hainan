<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Yezhu;

class YezhuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = [];
        $query = Yezhu::query();
        if($request->keyword) {
            $param['keyword'] = $request->keyword;
            $query->where('name','like','%'.$request->keyword.'%');
        }

        if($request->unite_num) {
            $param['unite_num'] = $request->unite_num;
            $query->where('unite_num',$request->unite_num);
        }
        $list = $query->paginate(20);      
        return view('admin.yezhu.index',compact('list','param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.yezhu.add');
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
       
        $rs   = Yezhu::create($data);
        if($rs) {
            return redirect('zadmin/yezhu');
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
        $data = Yezhu::find($id);
       
        return view('admin.yezhu.edit',compact('data'));
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
       
        $rs   = Yezhu::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/yezhu');
        }
        return back()->withInput();
    }

    
    public function destroy($id)
    {
        $rs = Yezhu::destroy($id);
        if ($rs) {
            return redirect('zadmin/yezhu');
        }
        return back();
    }
}
