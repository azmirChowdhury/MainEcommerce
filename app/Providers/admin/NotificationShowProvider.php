<?php

namespace App\Providers\admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use View;
class NotificationShowProvider extends ServiceProvider
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
        View::composer('back_end/includes/header',function ($view){
            $view->with('notification_user',User::where('status',1)
                ->where('id',Auth::user()->id)
                ->first()
            );

        });
    }
}
