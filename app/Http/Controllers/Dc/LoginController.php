<?php

namespace App\Http\Controllers\Dc;

use App\Models\DiancanShopUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dingcan.login');
    }

    

    public function doLogin(Request $request)
    {
        $rs['status'] = false;
        $mobile   = trim($request->mobile);
        $password = trim($request->password);

        $where['mobile']   = $mobile;        
        $user = DiancanShopUser::where($where)->first();
        //dd($user);
        if ($user) {

            if ($password == $user->password) {
                $wechat_user =  session('wechat.oauth_user.default');
                //dd($wechat_user);
                $user->openid   = $wechat_user->id;
                $user->nickname = $wechat_user->nickname;
                $user->avatar   = $wechat_user->avatar;
                $user->save();
                $request->session()->put('dcadmin', $user);

                return redirect('diancan/shop/');
            } else {
                $rs['msg'] = '密码错误';
                return redirect('diancan/shop/login')->with('rs', $rs);
            }
            //dd(1);
        }
        $rs['msg'] = '用户不存在';
        return redirect('diancan/shop/login')->with('rs',$rs );
    }

    public function wxLogin(Request $request)
    {
        $rs['status'] = 'danger';
        $rs['msg']    = '未绑定微信';
        $wechat_user =  session('wechat.oauth_user.default');  
        if( empty(object_get($wechat_user,'id')) ) {
            return back()->with('rs',$rs);    
        } 

        $user = DiancanShopUser::where('openid',$wechat_user->id)
                                ->first();
        if($user) {
            $request->session()->put('dcadmin', $user);
            return redirect('diancan/shop/orders');    
        }  
        return back()->with('rs',$rs);   
             
        
        
    }

    public function home()
    {
        $list = [];
        return view('dingcan.user.index',compact('list'));
    }

    public function logout(Request $request)
    {
        $request->session()->put('dcadmin', '');
        return redirect('diancan/shop/login');
    }
}
