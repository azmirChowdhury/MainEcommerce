<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\ProductColorModel;
use App\Models\ProductImageGalleryModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use DB;

class FrontProductController extends Controller
{
    public function single_product($slug, $id)
    {
        $product = ProductModel::where('slug', $slug)
            ->where('id', $id)
            ->where('status', 1)->first();
        if ($product != null) {

            $related_products=ProductModel::where('status',1)
                ->where('category_id',$product->category_id)
                ->where('id','!=',$product->id)
                ->limit(10)
                ->get();
            $data['images'] = $this->Images($product->id);
            $data['colors'] = $this->Color($product->id);
            $data['sizes'] = $this->Size($product->id);
            $data['category'] = SubcategoryModel::where('id', $product->category_id)->first();

            return view('front_end.products.show_singel_product', ['product' => $product, 'other_info' => $data,'related_products'=>$related_products]);
        } else {
            return redirect('/');
        }
    }

    private function Images($id)
    {
        $image_gallery = ProductImageGalleryModel::where('product_id', $id)->first();
        if ($image_gallery != null) {
            return json_decode($image_gallery->images);
        }
    }

    private function Color($id)
    {
        $color = ProductColorModel::where('product_id', $id)->first();
        if ($color != null) {
            return json_decode($color->color_name);
        }

    }

    private function Size($id)
    {
        $size = ProductSizeModel::where('product_id', $id)->first();
        if ($size != null) {
            return json_decode($size->product_size);
        }
    }

    public function category_show_product($slug, $id, $paginate)
    {

        $categories = SubcategoryModel::where('status', 1)
            ->where('id', $id)
            ->where('slug', $slug)
            ->first();
        $products = ProductModel::where('category_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate($paginate);
        if ($categories != null) {
            return view('front_end.products.shop_products', ['shop_category' => $categories, 'products_shop' => $products]);
        } else {
            return redirect('/');
        }
    }

    public function view_paginate(request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);
        $category = SubcategoryModel::where('status', 1)
            ->where('id', $request->id)
            ->first();
        return redirect($category->slug . '/' . $category->id . '/' . $request->paginate_value . '/shop');

    }

    public function price_range(request $request)
    {
        $this->validate($request, [
            'min' => 'required|integer',
            'max' => 'required|integer',
            'category_id' => 'required|integer',
            'paginate_v' => 'required|integer',
        ]);
        $min = $request->min;
        $max = $request->max;

        $category = SubcategoryModel::where('status',1)
            ->where('id', $request->category_id)
            ->first();
        if ($category != null) {


            $production = DB::table('product_models')->where('sale_price', '>=', $min)
                ->where('sale_price', '<=', $max)
                ->where('category_id', $category->id)
                ->where('status',1)
                ->paginate($request->paginate_v);
            if ($production != null) {

                return view('front_end.products.shop_products', ['shop_category' => $category, 'products_shop' => $production, 'max_p' => $max, 'min_p' => $min]);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }

    public function search_suggestion(request $request)
    {
        $category_id = SubcategoryModel::where('status', 1)->where('id', $request->category_id)->first();
        $products_suggestion = ProductModel::where('status', 1)->where('category_id', $category_id->id)->where('product_name', 'LIKE', '%' . $request->search_shop . '%')->get();
        $suggestion = '';
        foreach ($products_suggestion as $product) {
            $suggestion .= "<datalist id='search_value'>
                    <option value='$product->product_name'>
                 </datalist>";

        }
        return $suggestion;
    }

    public function search_shop(request $request, $paginate)
    {
        $category = SubcategoryModel::where('status', 1)->where('id', $request->cat_id)->first();
        if ($category != null) {
            $product = ProductModel::where('status', 1)
                ->where('product_name', 'LIKE', '%' . $request->search_shop . '%')
                ->where('category_id', $category->id)
                ->orderBy('id', 'desc')
                ->paginate($paginate);

            return view('front_end.products.shop_products', ['shop_category' => $category, 'products_shop' => $product, 'search_data' => $request->search_shop]);
        } else {
            return redirect('/');
        }
    }

    public function show_all_product()
    {
        $all_products_shop = ProductModel::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(50);
        return view('front_end.products.show_all_product', compact('all_products_shop'));
    }

}
