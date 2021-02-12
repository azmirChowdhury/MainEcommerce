<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\admin\slug_controller;
use App\Http\Controllers\Admin\DeleteFunction\BrandDeleteController;

class BrandController extends Controller
{
    public function index()
    {
        return view('back_end.brands.add_brands');
    }

    private function validation($request)
    {
        $request->validate([
            'brand_name' => 'required|max:40',
            'status' => 'required|integer|max:1|min:0|'
        ]);
    }

    private function image_save($request)
    {
        $this->validate($request, [
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $random = rand(1415, 5454);
        $file = $request->file('brand_image');
        $extension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/Brand_image/';
        $name = $random . $request->brand_name . '.' . $extension;
        $file->move($directory, $name);
        $image_info = $directory . $name;
        return $image_info;
    }

    private function imageDelete($request)
    {
        app(BrandDeleteController::class)->BrandimageDelete($request);
    }

    private function insert_data($request, $image_info, $work)
    {
        if ($work == 'i') {
            $model=BrandModel::all();
            $slug=app(slug_controller\SluConfier::class)->for_insert_slug($request->brand_name,$model,'brand_slug');
            $brand = new BrandModel();
        } else {
            $brand = BrandModel::find($request->id);
            $slug=app(slug_controller\SluConfier::class)->slug_Create($request->brand_name,$brand);
        }
        $brand->brand_name = $request->brand_name;
        $brand->slug=$slug;
        $brand->brand_image = $image_info;
        $brand->status = $request->status;
        return $brand;
    }

    public function save_brand(request $request)
    {
        try {
            $this->validation($request);
            $work = 'i';
            $image_info = $this->image_save($request);

            $brand = $this->insert_data($request, $image_info, $work);
            $brand->save();
            return redirect('/dashboard/add/brand/add-brands')->with('massage', 'Brand save successful');

        } catch (Exception $e) {
            return redirect('/dashboard/add/brand/add-brands')->with('massage', 'Brand failed to save');
        }
    }


    public function manage_brand()
    {
        $brand = BrandModel::all();
        return view('back_end.brands.manage_brands', ['brands' => $brand]);
    }

    public function brand_publish($id)
    {
        $brand = BrandModel::find($id);
        $brand->status = 1;
        $brand->update();
        return redirect('/dashboard/manage/brands/manage-brand')->with('massage', 'Status Published successful');
    }

    public function brand_unpublished($id)
    {
        $brand = BrandModel::find($id);
        $brand->status = 0;
        $brand->update();
        return redirect('/dashboard/manage/brands/manage-brand')->with('massage', 'Status Unpublished successful');
    }

    public function edit_brand($id)
    {
        $brand = BrandModel::find($id);
        $category = SubcategoryModel::where('status', 1)->get();
        return view('back_end.brands.edit_brands', ['categories' => $category, 'brand' => $brand]);
    }

    public function edit_save_brand(request $request)
    {
        $this->validation($request);
        $work = 'u';
        try {
            if (file_exists($request->brand_image)) {
                $id=$request->id;
                $this->imageDelete($id);
                $image_info = $this->image_save($request);
                $brand = $this->insert_data($request, $image_info, $work);
                $brand->update();
                return redirect('/dashboard/manage/brands/manage-brand')->with('massage', 'Brand Update successful');
            } else {
                $image_info = $request->image;
                $brand = $this->insert_data($request, $image_info, $work);
                $brand->update();
                return redirect('/dashboard/manage/brands/manage-brand')->with('massage', 'Brand Update successful');
            }
        } catch (Exception $e) {
            return redirect('/dashboard/manage/brands/manage-brand')->with('errors', "Brand can't Update ");
        }


    }

    public function delete_brand($id)
    {
        try {

            $this->imageDelete($id);
            app(BrandDeleteController::class)->delete_Brand_Data($id);
            return redirect('/dashboard/manage/brands/manage-brand')->with('massage', 'Brand delete successful');

        }catch (Exception $e){
            echo 'not delete';
        }
    }


}
