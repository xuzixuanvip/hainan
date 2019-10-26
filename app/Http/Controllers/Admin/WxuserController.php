<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wxuser;
use App\Repos\RoleRepo;
use App\Services\Wechat;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class WxuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Wxuser::query();
        if($request->keyword){
            $query->where('nickname','like','%'.$request->keyword.'%');
           // $query->orWhere
        }
        $list   =  $query->paginate(20);
        $roles  = RoleRepo::getRoles();
        return view('admin.wxuser.index',compact('list','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wxuser.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','thumb');
       
        $rs   = Wxuser::create($data);
        if($rs) {
            return redirect('zadmin/Wxusers');
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
        $data = Wxuser::find($id);
        return view('admin.wxuser.edit',compact('data'));
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
        $data = $request->except('_token','_method','thumb');
        
        $rs   = Wxuser::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/Wxusers');
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
        $rs = Wxuser::destroy($id);
        if ($rs) {
            return redirect('zadmin/Wxusers');
        }
        return back();
    }


    /**
     * 拉取服务端用户
     */
    public function pull(Request $request)
    {
        $list = Wechat::getUser();
        //dd($list);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($list);
 
        // Define how many items we want to be visible in each page
        $perPage = 10;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
        $list  = $paginatedItems;
        $roles   = RoleRepo::getRoles();
        return view('admin.wxuser.fans',compact('list','roles'));
    }

    public function import(Request $request)
    {
        $rs['status'] = 'success';
        try {
            Wxuser::query()->truncate();
            $list = Wechat::getUser();
           //dd($list);
            $total = count($list);
            foreach ($list as $k => $v) {
                array_pull($v,'tagid_list');
                Wxuser::create($v);
            }
            
        } catch (\Exception $e) {
            $rs['status'] = 'warning';
            $rs['msg'] = $e->getMessage();
            return back()->with('rs',$rs);
        }
        
        $rs['msg'] = '导入成功，本次导入'.$total.'条';

        return redirect('zadmin/wechat/wxuser')->with('rs',$rs);
    }

    /**
     * 微信用户保存到用报表
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveToUser(Request $request)
    {
        $data = $request->except(['_token']);
        $salt = $string = str_random(40);
        $data['username'] = $data['nickname'];
        $data['password'] = md5('111111'.$salt);
        $data['salt']     = $salt;  
        
        $flag = User::create($data);
        if($flag) {
            return redirect('zadmin/users');
        }
        return back()->withInput();
    }
}
