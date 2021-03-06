<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use DB;

class FrontHomeController extends Controller
{

    public function index(){
        $category_all_product=DB::table('subcategory_models')
            ->orderBy('count', 'DESC')
            ->where('status', 1)
            ->get()
            ->take(4);
        $product_all_section=$this->all_product_section($category_all_product);
        return view('front_end.home.index',compact('product_all_section','category_all_product'));
    }

    private function all_product_section($category)
    {

        if (count($category) >= 1) {
            $product_all_section['one'] = ProductModel::where('status', 1)
                ->where('category_id', $category[0]->id)
                ->orderBy('id', 'DESC')
                ->get()
                ->take(8);


            if (count($category) >= 2) {
                $product_all_section['tow'] = ProductModel::where('status', 1)
                    ->where('category_id', $category[1]->id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->take(8);
            }
            if (count($category) >= 3) {
                $product_all_section['three'] = ProductModel::where('status', 1)
                    ->where('category_id', $category[2]->id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->take(8);
            }
            if (count($category) >= 4) {
                $product_all_section['fore'] = ProductModel::where('status', 1)
                    ->where('category_id', $category[3]->id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->take(8);
            }

            return $product_all_section;

        }

    }


}
