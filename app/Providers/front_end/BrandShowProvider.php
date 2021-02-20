<?php

namespace App\Providers\front_end;

use App\Models\BrandModel;
use Illuminate\Support\ServiceProvider;
use View;

class BrandShowProvider extends ServiceProvider
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
            $view->with('showBrand',BrandModel::where('status',1)->get());
        });
    }
}
