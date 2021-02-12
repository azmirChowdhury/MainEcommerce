<?php

namespace App\Http\Middleware\admin\coUser;

use App\Models\admin\Co_UserModel;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryMiddleware
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
        $permission=Co_UserModel::where('user_id',Auth::user()->id)->first();
        $role=json_decode($permission->permission);

        if (in_array(1,$role)==true||Auth::user()->role==1){
            return $next($request);
        }

        return redirect(app(RouteServiceProvider::HOME));
    }
}
