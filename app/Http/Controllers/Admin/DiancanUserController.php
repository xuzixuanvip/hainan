<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiancanUser;
use App\Models\Wxuser;
use App\Models\Depart;
use App\Models\DiancanOrder;

class DiancanUserController extends Controller
{
    
    public function index(Request $request)
    {
        $where = $param = [];
        $page = $request->page? :1;
        $num  = 20;
        $start = $page>1?(($page-1)*$num+1):1;
        $departs = Depart::all();
        if($request->department) {
            $param['department'] = $where['department'] = trim($request->department);
        }
        if($request->keyword) {
            $param['keyword'] = trim($request->keyword);
            $where['name']    = trim($request->keyword);
        }
        $total_user = DiancanUser::where($where)->count();
        $list = DiancanUser::where($where)->paginate(20);
        $wxusers = Wxuser::all();

        // 昨日下单用户
        $yesterday = date('Y-m-d',strtotime("yesterday"));
        $yesterday_user = DiancanOrder::whereDate('created_at',$yesterday)->count();

        $today = date('Y-m-d');
        $today_user = DiancanOrder::whereDate('created_at',$today)->count();

        //dd($yesterday_user);
        return view('admin.diancanuser.index',compact('list','wxusers','departs','param','start','total_user','yesterday_user','today_user'));
    }

    public function create()
    {
        $wxusers = Wxuser::all();
        $departs = Depart::all();
        return view('admin.diancanuser.add',compact('wxusers','departs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = mt_rand(100000,999999);
        $data['money'] = $data['day_money'];
        $data['token'] = str_random(16);
        $flag = DiancanUser::create($data);
        return redirect('zadmin/diancan/users');
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
        $wxusers = Wxuser::get();
        $data = DiancanUser::find($id);
        $departs = Depart::all();
        //dd($wxusers);
        return view('admin.diancanuser.edit',compact('data','wxusers','departs'));
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
        $data = $request->except(['_token','_method']);
        $flag = DiancanUser::where('id',$id)->update($data);
        return redirect('zadmin/diancan/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag = DiancanUser::destroy($id);
        return back();
    }
}
