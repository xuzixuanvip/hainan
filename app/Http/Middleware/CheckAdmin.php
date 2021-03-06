<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckAdmin
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
        //验证管理员是否登录 如果未登录则跳转到登录页面
        if (!Session::has('admin')) {
            return redirect('zadmin/login');
        }
        return $next($request);
    }
}
