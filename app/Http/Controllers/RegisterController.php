<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\User;
use App\Models\Area;
use App\Http\Requests\SellerRequest;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [];
    	return view('hrs.reg',compact('data'));
    }

    public function regdo(SellerRequest $request)
    {
    	$rs['status'] = false;

    	$data    = $request->except(['_token','idcard_a','idcard_b','zhizhao_pic','smscode']);
    	if( session('smscode') == $request->smscode) {
            $rs['msg'] = '短信验证码已发送';
    		$request->session()->forget('smscode');
    	} else {
    		$rs['msg'] = '短信验证码错误';
    		return back()->withInput()->with('rs',$rs);
    	}
    	
        DB::beginTransaction();
        try {
        	$user = new User;
        	$user->username = $data['mobile'];
        	$user->type     = 1;
        	$user->status   = 0; //需要审核
        	$user->save();
        	$data['user_id'] = $user->id;
        	//dd($request->file('idcard_a'));
            $path = 'public/seller/'.date('Ymd');
        	if ($request->file('idcard_a')) {
        		$ext      = $request->idcard_a->extension();
        		$filename = date('ymd').str_random(10).'.'.$ext;
                
        		$request->idcard_a->storeAs($path, $filename);
                $data['idcard_a'] = '/storage/seller/'.date('Ymd').'/'.$filename;
        	}
        	if ($request->file('idcard_b')) {
        		$ext      = $request->idcard_b->extension();
        		$filename = date('ymd').str_random(10).'.'.$ext;
        		$request->idcard_b->storeAs($path, $filename);
                $data['idcard_b'] = '/storage/seller/'.date('Ymd').'/'.$filename;
        	}
        	if ($request->file('zhizhao_pic')) {
        		$ext      = $request->zhizhao_pic->extension();
        		$filename = date('ymd').str_random(10).'.'.$ext;
        		$request->zhizhao_pic->storeAs($path, $filename);
                $data['zhizhao_pic'] = '/storage/seller/'.date('Ymd').'/'.$filename;
        	}
        	$flag = Seller::create($data);
        	
        	if ($flag) {
        		DB::commit();
                $rs['status'] = true;
                $rs['msg'] = '注册成功，管理员正在审核中，请耐心等待';
                return redirect('login')->with('rs',$rs);
        	} 
        } catch (\Exception $e) {
            DB::rollBack();
            $rs['msg'] = $e->getMessage();
            return back()->withInput()->with('rs',$rs);
            
        }

        $rs['msg'] = '注册失败';
    	return back()->withInput()->with('rs',$rs);
    }
}
