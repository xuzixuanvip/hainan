<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\DiancanShopUser;

class CheckShopAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rs['msg'] = '请先登录';
        $rs['status'] = 'danger';
        $wechat_user =  session('wechat.oauth_user.default');
        $where['openid'] = $wechat_user->id;
        $user = DiancanShopUser::where($where)->first();
        
        if ($user) { 
            $request->session()->put('dcadmin', $user);
        }
        if (!Session::has('dcadmin')) {
            return redirect('diancan/shop/login')->with('rs',$rs);
        }
        //dd(session('dcadmin'));
        return $next($request);
    }
}
