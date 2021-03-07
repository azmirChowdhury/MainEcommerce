<?php

namespace App\Providers\front_end;

use App\Models\MetaScriptModel;
use Illuminate\Support\ServiceProvider;
use View;

class ScriptMetaProviderFront extends ServiceProvider
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
      View::composer('front_end.index',function ($view){

          $view->with('SeoMetas',MetaScriptModel::where('status',1)->get());

      });
    }
}
