<?php

namespace App\Providers\admin;

use App\Models\ProductModel;
use Illuminate\Support\ServiceProvider;
use View;

class DashboardTotalProductProvider extends ServiceProvider
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
           $view->with('total_product',ProductModel::all());
       });
    }
}
