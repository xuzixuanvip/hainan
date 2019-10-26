<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\User;

class CheckUser
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
       
        
        //验证卖家是否登录 如果未登录则跳转到登录页面
        if (!Session::has('user')) {
            return redirect('login');
        }
        return $next($request);
    }
}
