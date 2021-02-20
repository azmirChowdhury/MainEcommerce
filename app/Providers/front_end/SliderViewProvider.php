<?php

namespace App\Providers\front_end;

use App\Models\SliderModel;
use Illuminate\Support\ServiceProvider;
use View;

class SliderViewProvider extends ServiceProvider
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
        View::composer('front_end.includes.slider',function ($view){
            $view->with('sliderView',SliderModel::all());
        });
    }
}
