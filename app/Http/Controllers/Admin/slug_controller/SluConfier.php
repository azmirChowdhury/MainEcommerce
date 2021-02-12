<?php

namespace App\Http\Controllers\admin\slug_controller;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SluConfier extends Controller
{



    public function slug_Create($request,$model)
    {
        $convert=Str::slug($request,'-');
        if ($model->slug==$convert||$model->slug!=$convert){
            $array=[1,2,3,4,5,6,7,8,9,10];
            $random=Str::random(5,$array);
            $slug=Str::slug($request.' '.$random,'-');
            return $slug;
        }
    }


    public function for_insert_slug($request,$model){

        $slu=Str::slug($request,'-');
        $find=0;
        foreach ($model as $slug){
            if ($slug->slug_brand==$slu){
                $find+=1;
            }else{
                $find+=0;
            }
        }
        if ($find!=0){
            $array=[1,2,3,4,5,6,7,8,9,10];
            $random=Str::random(5,$array);
            $slug=Str::slug($request.' '.$random,'-');
        }else{
            $slug=Str::slug($request,'-');
        }
        return $slug;

    }

}
