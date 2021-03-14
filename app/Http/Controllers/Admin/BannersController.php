<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\deletefunction\BannerDelete;
use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use Image;

class BannersController extends Controller
{
    public function index()
    {
        $banner = BannerModel::all();
        return view('back_end.banners.manage_banners', ['banners' => $banner]);
    }

    public function banners_add()
    {
        $category = SubcategoryModel::all();
        return view('back_end.banners.add_banner', ['categories' => $category]);
    }

    private function validation($request)
    {
        $this->validate($request, [
            'banner_name' => 'required',
            'banner_role' => 'required|integer',
            'status' => 'required:min:0|max:1',

        ]);

        if ($request->banner_role == 7) {
            $this->validate($request, [
                'category_id' => 'required|integer',
            ]);
        }
        if (!empty($request->id)) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);
        }

    }

    private function image_insert($request)
    {
        $this->validate($request, [
            'banner_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg',
        ]);
        $rand = rand(1, 10000);
        $file = $request->file('banner_image');
        $extension = $file->getClientOriginalExtension();
        $original_name = $file->getClientOriginalName();
        $directory = 'back_end/images/banner_images/';
        $bname = $original_name;
        $banner_name = $directory . $rand . '_' . $bname . '.' . $extension;
        Image::make($file)->save($banner_name);
        return $banner_name;
    }

    private function image_delete($request)
    {
        $banners = BannerModel::find($request->id);
        if ($banners != null) {
            unlink($banners->banner_image);
        }
    }

    private function banner_information_insert($request, $image, $work)
    {
        if ($work == 'i') {
            $banner = new BannerModel();
        } else {
            $banner = BannerModel::find($request->id);
        }
        $category = $request->banner_role != 7 ? 0 : $request->category_id;
        $banner->banner_name = $request->banner_name;
        $banner->banner_role = $request->banner_role;
        $banner->banner_image = $image;
        $banner->category_id = $category;
        $banner->status = $request->status;
        return $banner;
    }

    public function save_new_banner(request $request)
    {
        $this->validation($request);
        $banner_name = $this->image_insert($request);
        $banner = $this->banner_information_insert($request, $banner_name, 'i');
        $banner->save();
        return redirect('/dashboard/appearance/banners/add-banner')->with('massage', 'Your banner save successful');
    }

    public function edit_banner($id)
    {
        $banner = BannerModel::find($id);
        if ($banner != null) {
            $category = SubcategoryModel::all();
            return view('back_end.banners.edit_banner', ['banner' => $banner, 'categories' => $category]);
        }else{
            return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner was deleted');
        }
    }


    public function edit_save_banner(request $request)
    {
        $this->validation($request);
        $banner = BannerModel::find($request->id);
        if ($banner!=null) {
            if (file_exists($request->banner_image)) {
                $this->validate($request, [
                    'banner_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
                ]);
                $this->image_delete($request);
                $banner_name = $this->image_insert($request);
                $banner = $this->banner_information_insert($request, $banner_name, 'u');
                $banner->update();
            } else {
                $banner_model = BannerModel::find($request->id);
                $banner = $this->banner_information_insert($request, $banner_model->banner_image, 'u');
                $banner->update();
            }
        }else{
            return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner was deleted');
        }
        return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner update successful');
    }

    public function delete_banner($id)
    {
        app(BannerDelete::class)->banner_delete_function($id);
        return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner delete successful');

    }

    public function publish_banner($id)
    {
        $banner = BannerModel::find($id);
        if ($banner!=null) {
            $banner->status = 1;
            $banner->update();
        }else{
            return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner was deleted');
        }
        return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner ' . $banner->banner_name . ' Published successful');
    }

    public function unpublished_banner($id)
    {
        $banner = BannerModel::find($id);
        if ($banner!=null){
        $banner->status = 0;
        $banner->update();
        }else{
            return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner was deleted');
        }
        return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner ' . $banner->banner_name . ' Unpublished successful');
    }

    public function full_view_banner($id)
    {
        $banner = BannerModel::find($id);
        if ($banner!=null){
        $category = SubcategoryModel::find($banner->category_id);
        return view('back_end.banners.full_view_banner', ['banner' => $banner, 'category' => $category]);
        }else{
            return redirect('/dashboard/appearance/banners/manage-banners')->with('massage', 'Banner was deleted');
        }
    }
}
