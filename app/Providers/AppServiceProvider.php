<?php

namespace App\Providers;

use App\BrandModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);

        View::composer('*',function ($view){
//            $view->with('mainUrl','http://localhost/MainEcommerce/public');
            $view->with('mainUrl',url('/'));
        });

    }
}
