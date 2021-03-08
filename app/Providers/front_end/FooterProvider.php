<?php

namespace App\Providers\front_end;

use App\Models\NotesModel;
use App\Models\PagesModel;
use App\Models\SocialIconModel;
use Illuminate\Support\ServiceProvider;
use View;

class FooterProvider extends ServiceProvider
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
        View::composer('front_end.includes.footer',function ($view){
            $view->with('notesFooter',NotesModel::where('status',1)->get());
        });
        View::composer('front_end.includes.footer',function ($view){
            $view->with('PagesFooter',PagesModel::where('status',1)->get());
        });
        View::composer('*',function ($view){
            $view->with('SocialLink',SocialIconModel::where('status',1)->get());
        });
    }
}
