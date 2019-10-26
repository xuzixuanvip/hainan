<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\MessageRepo;
use App\Models\Yijian;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $list   = MessageRepo::pages();
       
        return view('admin.message.index',compact('list'));
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
        $data = MessageRepo::find(['id'=>$id]);
      
        return view('admin.message.edit',compact('data'));
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

        $flag   = VisaOrder::where('id',$id)->update($data);

        $map['order_id']   = $data['id'];
        $map['process_id'] = (int)$request->process_id;
        $orderProcess['status'] = 1;
        $orderProcess['remark'] = $request->reamrk;
        VisaOrderProcess::where($map)->update($orderProcess);

        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/visa/order');
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
         $rs = MessageRepo::destroy($id);
        if ($rs) {
            return redirect('zadmin/message');
        }
        return back();
    }

    public function reply(Request $request)
    {
        $rs['status'] = 'danger'; 
        $rs['msg']    = '保存失败';
        $id = (int)$request->id;
        $msg = MessageRepo::find(['id'=>$id]);
        if($msg) {
            $msg->reply    = $request->reply;
            $msg->reply_at = date('Y-m-d H:i:s');
            $msg->status   = 1;
            $msg->save();
            $rs['status'] = 'success';
            $rs['msg']    = '回复成功';
            return back()->with('rs',$rs);
        }
        return back()->with('rs',$rs);
    }

    public function yijian(Request $request)
    {
        $list = Yijian::paginate(10);
        return view('admin.yijian.index',compact('list'));
    }

    
}
