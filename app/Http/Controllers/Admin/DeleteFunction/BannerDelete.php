<?php

namespace App\Http\Controllers\admin\deletefunction;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use Illuminate\Http\Request;

class BannerDelete extends Controller
{
    public function banner_delete_function($id){
        $banner=BannerModel::find($id);
        if ($banner!=null){
            unlink($banner->banner_image);
            $banner->delete();
        }

    }
}
