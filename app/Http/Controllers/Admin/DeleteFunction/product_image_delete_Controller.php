<?php

namespace App\Http\Controllers\admin\deletefunction;

use App\Http\Controllers\Controller;
use App\Models\ProductImageGalleryModel;
use Illuminate\Http\Request;

class product_image_delete_Controller extends Controller
{
    public function gallery_image($request_id){
        $image=ProductImageGalleryModel::where('product_id',$request_id)->first();
        if (!$image==null){
            $images=json_decode($image->images);
            foreach ($images as $img){
                unlink($img);
            }
            $image->delete();
        }

    }

}
