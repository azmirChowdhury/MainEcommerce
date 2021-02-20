<?php

namespace App\Providers\front_end;

use App\Models\ProductModel;
use Illuminate\Support\ServiceProvider;
use View;

class productShowProvider extends ServiceProvider
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
            $view->with('all_products',ProductModel::where('status',1)->get());
        });
    }
}
