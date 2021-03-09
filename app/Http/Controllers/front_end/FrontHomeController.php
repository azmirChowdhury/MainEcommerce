<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\PagesModel;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use DB;

class FrontHomeController extends Controller
{

    public function index()
    {
        $category_all_product = DB::table('subcategory_models')
            ->orderBy('count', 'DESC')
            ->where('status', 1)
            ->get()
            ->take(4);
        $feature_category = $this->feature_product();
        return view('front_end.home.index', compact('feature_category', 'category_all_product'));
    }

    private function feature_product()
    {
        $feature_category = SubcategoryModel::where('status', 1)
            ->where('feature_product', 1)
            ->orderBy('count', 'DESC')
            ->get();
        return $feature_category;
    }

    public function view_page_details($name, $id)
    {
        $page_details = PagesModel::where('status', 1)
            ->where('id', $id)
            ->first();
        if ($page_details != null) {
            return view('front_end.pages.page_details_view', compact('page_details'));
        } else {
            return redirect('/');
        }
    }


    public function search_all_product_suggest(request $request)
    {

        $product = ProductModel::where('status', 1)
            ->where('product_name', 'LIKE', '%' . $request->search_val . '%')->get();
        $category=SubcategoryModel::where('status', 1)
            ->where('category_name', 'LIKE', '%' . $request->search_val . '%')->get();
        $brands=BrandModel::where('status', 1)
            ->where('brand_name', 'LIKE', '%' . $request->search_val . '%')->get();

        $p = array();
        foreach ($product as $pp) {
            $p[] .= $pp->product_name;
        }
        foreach ($category as $pp) {
            $p[] .= $pp->category_name;
        }
        foreach ($brands as $pp) {
            $p[] .= $pp->brand_name;
        }

        return response()->json([
            'name' => $p,
        ]);
    }

    public function search_products(request $request){
        print_r($request);

    }

}
