<?php

namespace App\Http\Controllers\Admin\DeleteFunction;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use Illuminate\Http\Request;

class BrandDeleteController extends Controller
{
    public function BrandimageDelete($request){

        $brand = BrandModel::find($request);
        unlink($brand->brand_image);
    }
    public function delete_Brand_Data($request){
        $brand = BrandModel::find($request);
        $brand->delete();
    }
}
