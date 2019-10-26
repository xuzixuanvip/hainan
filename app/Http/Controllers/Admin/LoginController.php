<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
         //dd(md5(trim('222222').'111111'));
    	return view('admin.login');
    }

    public function loginDo(Request $request)
    {    	
        
        $username  = $request->username;
    	$password = $request->password;

        if(str_contains($request->username, '@')){
            $where['email'] = $username;    
        } else {
            $where['username']  = $username;
        }
        
    	$user = User::where($where)->first();
        
        //dd($where,$user,md5($password.$user->salt),$user->password);
    	if($user) {
            
    		if(md5($password.$user->salt) == $user->password) {
    			$request->session()->put('admin', $user);                
                return redirect('zadmin/');
    		}else{
    		  return redirect('zadmin/login')->with('rs','密码错误');	
    		}
    	}
        return redirect('zadmin/login')->with('rs','用户不存在');

    }

    public function logOut(Request $request)
    {
        $request->session()->forget('admin');
        return redirect('zadmin/login');
    }

    
}
