<?php

namespace App\Providers\admin;

use App\Models\Logo_BackgroundModel;
use Illuminate\Support\ServiceProvider;
use View;

class LogoBackgroundProvider extends ServiceProvider
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
        View::composer('*',function ($view){
            $view->with('appearance_image',Logo_BackgroundModel::first());
        });
    }
}
