<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Yezhu;

class FeeController extends Controller
{
    
    public function index(Request $request)
    {
        $param = [];
        $query   = Yezhu::query();
        if($request->keyword) {
            $param['keyword'] = $request->keyword;
            $query->where('name','like','%'.$request->keyword.'%');
        }

        if($request->unite_num) {
            $param['unite_num'] = $request->unite_num;
            $query->where('unite_num',$request->unite_num);
        } 

        $yezhus   = $query->get();
        $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $fees = [];
        foreach ($yezhus as $k => $v) {
            foreach ($months as $key => $value) {
                $year_month = date('Y').'-'.$value;
                $where['yezhu_id']   = $v->id;
                $where['year_month'] = $year_month;
                $where['fee_type_id'] = 1;
                $shuifei = Fee::where($where)->first();
                $where['fee_type_id'] = 2;
                $dianfei = Fee::where($where)->first();
                $fees[$v->id][$year_month]['shuifei']    = $shuifei;
                $fees[$v->id][$year_month]['dianfei'] = $dianfei;
            }
        }
        $feeTypes = FeeType::get();   
       //dd($fees);
        return view('admin.fee.index',compact('fees','feeTypes','param','yezhus','months'));
    }

    
    public function create(Request $request)
    {
        $query = Yezhu::query();
        $param = [];
        if($request->yezhu_id) {
            $query->where('id',$request->yezhu_id);
        }
        if($request->unite_num){
            $query->where('unite_num',$request->unite_num);
        }

        if($request->floor_num){
            $query->where('floor_num',$request->floor_num);
        }

        if($request->year_month) {
            $param['year_month'] = $request->year_month;
        }

        $yezhus = $query->get();
        $shuifei = FeeType::find(1);
        $dianfei = FeeType::find(2);
        return view('admin.fee.add',compact('yezhus','shuifei','dianfei','param'));
    }

    
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['niandu'] = explode(',', $data['year_month'])[0];
      
        foreach ($data['shuifei'] as $k => $v) {
            if(empty($v['current_num'])) continue ;
            $v['year_month'] = $data['year_month'];
            $v['yezhu_id']   = $k;
            $v['remark']     = $data['remark'];
            $rs   = Fee::create($v);
        }
        foreach ($data['dianfei'] as $key => $val) {
            if(empty($val['current_num'])) continue ;
            $val['year_month'] = $data['year_month'];
            $val['yezhu_id']   = $key;
            $rs   = Fee::create($val);
        }
        
        if($rs) {
            return redirect('zadmin/fee');
        }
        return back();
    }

    
    public function show($id)
    {
        //
    }

    
    public function change(Request $request)
    {
        $where = [];
        if($request->yezhu_id) {
            $where['yezhu_id'] = (int)$request->yezhu_id;
            $yezhu = Yezhu::find($where['yezhu_id']);
        } 
        if($request->year_month) {
            $where['year_month'] = trim($request->year_month);
        }
        $list = Fee::where($where)->get();
        

        return view('admin.fee.edit',compact('list','yezhu'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        //dd($data);
        $rs   = Fee::where('id',$id)->update($data);
        if($rs) {
            return redirect('zadmin/fee');
        }
        return back()->withInput();
    }

    
    public function del(Request $request)
    {
        $where['yezhu_id']   = $request->yezhu_id;
        $where['year_month'] = $request->year_month;
        
        $rs = Fee::where($where)->delete();
        if ($rs) {
            return redirect('zadmin/fee');
        }
        return back();
    }

    public function destroy($id)
    {

    }

    public function month(Request $request)
    {
        $rs['status'] = true;
        $month = strtotime($request->month);
        $preMonth = date('Y-m', strtotime('-1 month', $month));
       
        $where['year_month'] = $preMonth;
        $list = Fee::where($where)->get();
        $rs['data'] = $list;
        return response()->json($rs);
    }
}
