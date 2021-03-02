<?php

namespace App\Http\Middleware\front_end;

use Closure;
use Illuminate\Http\Request;
use Session;

class FrontHasLoginMiddleware
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
        if (Session::get('customer_id')==false&&Session::get('customer_email')==false){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
