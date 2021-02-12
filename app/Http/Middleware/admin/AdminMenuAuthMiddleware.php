<?php

namespace App\Http\Middleware\admin;

use Closure;
use Illuminate\Http\Request;

class AdminMenuAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        switch (){
//
//
//        }
        return $next($request);
    }
}
