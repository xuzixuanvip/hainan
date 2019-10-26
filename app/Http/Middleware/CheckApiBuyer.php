<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckApiBuyer
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
        $rs['status'] = false;
        if (!object_get(Auth::user(),'buyer')) {
            $rs['msg'] =  'Unauthenticated.';
            return response()->json($rs, 401);
        }
        
    }
}
