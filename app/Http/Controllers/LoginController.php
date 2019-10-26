<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $wechat_user =  session('wechat.oauth_user.default');
        
        $user = User::where('openid',$wechat_user->id)->first();
        if($user) {
            $request->session()->put('user', $user);
            return redirect('user/task');    
        }
        
        //$provinces  = $this->getDistrict(0);
    	return view('hrs.login');
    }

    /**
     * 老板登陆
     */
    public function loginDo(Request $request)
    {
    	//dd(session('smscode'));
        $wechat_user =  session('wechat.oauth_user.default'); // 拿到授权用户资料

        
        $rs['status'] = false;
        $username  = $request->username;
    	$password   = $request->password;

        if(str_contains($username, '@')){
            $where['email'] = $username;    
        } else {
            $where['username']  = $username;
        }
        
        
        
        

        //dd($where);
    	$user = User::where($where)->first();
        
    	if($user) {
            if(md5($password.$user->salt)==$user->password){
    		  
                $user->openid = $wechat_user->id;
                $user->save();
    			$request->session()->put('user', $user);                
                return redirect('user/task');
    		} else {
    		  $rs['msg'] = '密码错误';	
              return back()->withInput()->with('rs',$rs);
    		}
    	}
        $rs['msg'] = '用户不存在';
        return back()->withInput()->with('rs',$rs);

    }

    public function logOut(Request $request)
    {
        User::where(['id'=>session('user')->id])->update(['openid'=>'']);
        $request->session()->forget('user');
        return redirect('login');
    }

    public function reg(UserRequest $request)
    {
        $rs['status'] = false;
        $salt   = str_random(40);
        $user = new User;
        $user->username = $request->name;
        $user->email= $request->email;
        $user->type = 1; //1 卖家 2买家
        $user->salt = $salt;
        $user->rank = 1;
        $user->api_token = str_random(60);
        $user->password = md5($request->password.$salt);
       
        $flag = $user->save();
        if($flag) {
            $request->session()->put('user', $user);
            $rs['status'] = true;
            return response()->json($rs);
        }
        return $rs;
    }

    
}
