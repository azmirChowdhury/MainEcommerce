<?php

namespace App\Providers\front_end;

use App\Models\BannerModel;
use Illuminate\Support\ServiceProvider;
use View;

class BannerShowProvider extends ServiceProvider
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
           $view->with('BannersShow',BannerModel::where('status',1)->get());
       });
    }
}
