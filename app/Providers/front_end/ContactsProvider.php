<?php

namespace App\Providers\front_end;

use App\Models\ContactInfromationModel;
use Illuminate\Support\ServiceProvider;
use View;

class ContactsProvider extends ServiceProvider
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
          $view->with('contacts',ContactInfromationModel::first());
      });
    }
}
