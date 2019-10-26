<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VisaOrder;
use App\Models\VisaCountry;
use App\Models\VisaProcess;
use App\Models\VisaOrderProcess;

class VisaOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $list   = VisaOrder::paginate(10);
        $countries = VisaCountry::get();
        $processes = VisaProcess::get();
        //dd($countries);
        return view('admin.visa.order.index',compact('list','countries','processes'));
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
        $rs['status'] = 'warning';
        $rs['msg']    = '操作失败';
        $data = $request->except(['_token']);
       
        $num = VisaOrder::whereDate('created_at',date('Y-m-d'))->count();
        $num = $num?$num:1;
        $data['service_code'] = (string)$data['country_code'].date('dmY').str_pad($num,3,"0",STR_PAD_LEFT);;
        $flag = VisaOrder::create($data);
        $processes = VisaProcess::get();
        foreach ($processes as $k => $v) {
            $op['order_id'] = $flag->id;
            $op['process_id'] = $v->id;
            $op['status'] = $v->status;
            VisaOrderProcess::create($op);
        }
        
        if($flag) {
            $rs['status'] = 'success';
            $rs['msg']    = '操作成功';
            return redirect('zadmin/visa/order')->with('rs',$rs);
        }
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
        $data = VisaOrder::find($id);
        $countries = VisaCountry::get();
        $processes = VisaProcess::get();
        $orderProcess = VisaOrderProcess::where(['order_id'=>$id])->get();
        return view('admin.visa.order.edit',compact('data','orderProcess','processes','countries'));
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
         $rs = VisaOrder::destroy($id);
        if ($rs) {
            return redirect('zadmin/visa/order');
        }
        return back();
    }


    public function batchUpdate(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg'] = '';
        $codes = explode(',', $request->service_code);

        foreach ($codes as $code) {
            $where['service_code'] = trim($code);
            $order = VisaOrder::where($where)->first();
            if($order) {
                $order->process_id = (int)$request->process_id;
                $order->save();

                $map['order_id']   = $order->id;
                $map['process_id'] = (int)$request->process_id;
                $orderProcess['status'] = 1;
                $orderProcess['remark'] = $request->reamrk;
                VisaOrderProcess::where($map)->update($orderProcess);
            } else {
                $rs['msg'] .= '受理号码:'.$code.'不存在；';
                continue;
            }
        }
        if(empty($rs['msg'])) {
            $rs['status'] = 'success';
            $rs['msg'] = '操作成功';
            return back()->with('rs',$rs);
        }

        return back()->with('rs',$rs);
        
    }
}
