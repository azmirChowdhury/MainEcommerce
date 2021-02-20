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
               ->join('html_blocks_models','html_blocks_models.parents_category_id','=','parents_model_categories.id')
               ->select('html_blocks_models.*','parents_model_categories.*')
               ->get()
               ->where('status',1)
           );
       });
       View::composer('*',function ($view){
           $view->with('blocks',DB::table('html_blocks_models')
               ->join('parents_model_categories','html_blocks_models.parents_category_id','=','parents_model_categories.id')
               ->select('html_blocks_models.*','parents_model_categories.*')
               ->get()
               ->where('status',1)
           );
       });
       View::composer('*',function ($view){
           $view->with('scategories',DB::table('subcategory_models')
               ->join('html_blocks_models','html_blocks_models.id','=','subcategory_models.collum_id')
               ->select('subcategory_models.*')
               ->get()
               ->where('status',1)
           );
       });



    }
}
