<?php

namespace App\Http\Controllers\admin\deletefunction;

use App\Http\Controllers\Controller;
use App\Models\admin\SizeModel;
use App\Models\ProductSizeModel;
use Illuminate\Http\Request;

class ProductSizeDeleteController extends Controller
{
    public function deleteSize($request_id){
        $size = ProductSizeModel::find($request_id);
        if ($size!=null){
            $size->delete();
        }
    }
    public function product_Size_delete($request_id){
        $size = ProductSizeModel::where('product_id',$request_id)->first();
        if (!$size==null){
            $size->delete();
        }


    }
}
