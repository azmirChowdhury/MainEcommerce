<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Logo_BackgroundModel;
use Illuminate\Http\Request;
use Image;

class Logo_Background_controller extends Controller
{
    public function index()
    {
        return view('back_end.logo_background.add_logo_background');
    }

    private function logo_insert($request)
    {
        $this->validate($request, [
            'logo_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
        $random = rand(55, 500);
        $file = $request->file('logo_image');
        $extension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/logo_and_background/';
        $logo_name = $directory . $random . '_Logo' . '.' . $extension;
        Image::make($file)->save($logo_name);
        return $logo_name;

    }

    private function validation_before_image_delete($request, $info)
    {
        if (!empty($request->logo_image) == true) {
            $this->validate($request, [
                'logo_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
            ]);
        }
        if (!empty($request->background_image) == true) {
            $this->validate($request, [
                'background_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
            ]);
        }
        if (!empty($request->fav_icon) == true) {
            $this->validate($request, [
                'fav_icon' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
            ]);
        }

    }

    private function image_delete($id, $request)
    {

        $info = Logo_BackgroundModel::find($id);
        $this->validation_before_image_delete($request, $info);

        if (!empty($request->logo_image) == true) {
            unlink($info->logo);
        }
        if (!empty($request->background_image) == true) {
            unlink($info->background_image);
        }
        if (!empty($request->fav_icon) == true) {
            unlink($info->fav_icon);
            unlink($info->fav_icon_small);
        }

    }

    private function background_image_insert($request)
    {
        $this->validate($request, [
            'background_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
        $random = rand(55, 500);
        $file = $request->file('background_image');
        $extension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/logo_and_background/';
        $background_image_name = $directory . $random . '_background_image' . '.' . $extension;
        Image::make($file)->save($background_image_name);
        return $background_image_name;

    }

    private function favicon_insert($request, $size)
    {
        $this->validate($request, [
            'fav_icon' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
        $random = rand(15, 500);
        $file = $request->file('fav_icon');
        $extension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/logo_and_background/';
        $fav_icon_name = $directory . $random . '_' . $size . '_favicon' . '.' . $extension;
        Image::make($file)->resize($size, $size)->save($fav_icon_name);
        return $fav_icon_name;

    }

    private function information_insert($request, $data, $work)
    {
        if ($work == 'i') {
            $logo_background = new Logo_BackgroundModel();
        } else {
            $logo_background = Logo_BackgroundModel::find($request->id);
        }
        $logo_background->logo = $data['logo'];
        $logo_background->background_image = $data['background'];
        $logo_background->fav_icon = $data['large_icon'];
        $logo_background->fav_icon_small = $data['small_icon'];
        return $logo_background;
    }


    public function update_information(request $request)
    {
        $logo_background = Logo_BackgroundModel::find($request->id);
        if ($logo_background!=null){
        $this->image_delete($request->id, $request);
        if (!empty($request->logo_image) == true) {
            $logo_name = $this->logo_insert($request);
            $data['logo'] = $logo_name;
        } else {
            $data['logo'] = $request->DB_logo;
        }
        if (!empty($request->background_image) == true) {
            $background_image_name = $this->background_image_insert($request);
            $data['background'] = $background_image_name;
        } else {
            $data['background'] = $request->background_image_DB;
        }

        if (!empty($request->fav_icon) == true) {
            $fav_icon_name = $this->favicon_insert($request, 32);
            $fav_icon_small = $this->favicon_insert($request, 16);
            $data['large_icon'] = $fav_icon_name;
            $data['small_icon'] = $fav_icon_small;
        } else {
            $data['large_icon'] = $request->favicon_large;
            $data['small_icon'] = $request->favicon_small_img;
        }
        $logo_background = $this->information_insert($request, $data, 'u');
        $logo_background->update();
        return redirect('/dashboard/appearance/logo-background-management')->with('massage', 'Update successful');
        }else{
            return redirect('/dashboard/appearance/logo-background-management')->with('massage', 'was deleted');
        }

    }

    private function validation($request)
    {
        $this->validate($request, [
            'logo_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg',
            'background_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg',
            'fav_icon' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
    }

    public function new_appearance(request $request)
    {
        $this->validation($request);
        $logo_name = $this->logo_insert($request);
        $data['logo'] = $logo_name;
        $background_image_name = $this->background_image_insert($request);
        $data['background'] = $background_image_name;
        $fav_icon_name = $this->favicon_insert($request, 32);
        $fav_icon_small = $this->favicon_insert($request, 16);
        $data['large_icon'] = $fav_icon_name;
        $data['small_icon'] = $fav_icon_small;
        $logo_background = $this->information_insert($request, $data, 'i');
        $logo_background->save();
        return redirect('/dashboard/appearance/logo-background-management')->with('massage', 'Save successful');
    }
}
