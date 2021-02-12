<?php

namespace App\Http\Controllers\admin\deletefunction;

use App\Http\Controllers\Controller;
use App\Models\Admin\ColorModel;
use App\Models\ProductColorModel;
use Illuminate\Http\Request;

class Product_Color_Delete_Comtroller extends Controller
{
    public function colorDelete($request_id){
        $color = ProductColorModel::find($request_id);
        $color->delete();
    }
    public function product_color_delete($request_id){
        $color =ProductColorModel::where('product_id',$request_id)->first();
        if (!$color==null){
            $color->delete();
        }
    }
}
