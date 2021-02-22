<?php

namespace App\Providers\front_end;

use App\Models\ParentsModelCategory;
use Illuminate\Support\ServiceProvider;
use View;
use DB;

class ParentsMenu extends ServiceProvider
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
           $view->with('parents_menu',DB::table('parents_model_categories')
               ->where('status',1)
               ->get()
           );
       });
       View::composer('*',function ($view){
           $view->with('blocks',DB::table('html_blocks_models')
               ->where('status',1)
               ->get()
           );
       });
       View::composer('*',function ($view) {
           $view->with('scategories', DB::table('subcategory_models')
               ->join('html_blocks_models', 'html_blocks_models.id', '=', 'subcategory_models.collum_id')
               ->select('subcategory_models.*')
               ->get()
               ->where('status', 1)
           );
       });

           View::composer('*', function ($view) {
               $view->with('all_subc', DB::table('subcategory_models')
                   ->join('html_blocks_models', 'html_blocks_models.id', '=', 'subcategory_models.collum_id')
                   ->select('subcategory_models.*')
                   ->orderBy('count', 'ASC')
                   ->get()
                   ->where('status', 1)
                   ->take(10)

               );
           });



    }
}
