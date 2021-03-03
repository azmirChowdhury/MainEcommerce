<?php

namespace App\Providers\admin;

use App\Models\admin\Co_UserModel;
use App\Models\ContactMassageModel;
use App\Models\CustomerModel;
use App\Models\User;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;
use DB;


class DashboardAdminManageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer('back_end.user.manage_admin',function ($view){
           $view->with('admins_user',User::where('email','!=',Auth::user()->email)->get());
       });

       View::composer('back_end.includes.menu',function ($view){
           $view->with('permission',Co_UserModel::where('user_id',Auth::user()->id)->first());
       });
       View::composer('back_end.includes.menu',function ($view){
           $view->with('message_count',ContactMassageModel::where('status',0)->get());
       });
       View::composer('back_end.home.home',function ($view){
           $view->with('dashboard_customer_count',CustomerModel::where('status','!=',0)->get());
       });
    }
}
