<?php

namespace App\Http\Middleware\front_end;

use Closure;
use Illuminate\Http\Request;
use Session;

class CustomerDashboardMiddleware
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
        if (Session::get('customer_id')&&Session::get('customer_email')){
            return $next($request);
        }else{
            return redirect()->route('resister_customer');
        }
    }
}
