<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\ProductColorModel;
use App\Models\ProductImageGalleryModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
    public function single_product($slug,$id)
    {
        $product = ProductModel::where('slug', $slug)
            ->where('id', $id)
            ->where('status', 1)->first();
        if ($product!=null) {

            $data['images'] = $this->Images($product->id);
            $data['colors'] = $this->Color($product->id);
            $data['sizes'] = $this->Size($product->id);
            $data['category'] = SubcategoryModel::where('category_name', $product->category_name)->first();
            return view('front_end.products.show_singel_product', ['product' => $product, 'other_info' => $data]);
        }else{
            return redirect('/');
        }
    }
    private function Images($id){
        $image_gallery=ProductImageGalleryModel::where('product_id',$id)->first();
        if ($image_gallery!=null){
            return json_decode($image_gallery->images);
        }
    }
    private function Color($id){
        $color=ProductColorModel::where('product_id',$id)->first();
        if ($color!=null){
            return json_decode($color->color_name);
        }

    } private function Size($id){
        $size=ProductSizeModel::where('product_id',$id)->first();
        if ($size!=null){
            return json_decode($size->product_size);
        }
    }

}
