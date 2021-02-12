<?php

namespace App\Http\Controllers\Admin;

use App\Models\BrandModel;
use App\Models\HtmlBlocksModel;
use App\Models\ParentsModelCategory;
use App\Models\SubcategoryModel;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use App\Http\Requests\Parents_Category_Request;
use DB;
use App\Http\Controllers\Admin\DeleteFunction\BrandDeleteController;

class ParentsMenuController extends Controller
{
    public function index()
    {
        return view('back_end.Parents_menu.add_menu');
    }

    public function save_images($request)
    {
        $request->validate([
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $random = rand(1415, 5454);
        $file = $request->file('category_image');
        $extension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/parents_category/';
        $name = $random . $request->category_name . '.' . $extension;
        $file->move($directory, $name);
        $image_info = $directory . $name;
        return $image_info;
    }

    public function insert_data($request, $image_info)
    {
        if ($request->id == true) {
            $category = ParentsModelCategory::where('id', $request->id)->first();
        } else {
            $category = new ParentsModelCategory();
        }
        $category->parents_category_name = $request->category_name;
        $category->parents_category_image = $image_info;
        $category->status = $request->status;
        return $category;
    }

    public function validation($request)
    {
        $request->validate([
            'category_name' => 'required|max:40',
            'status' => 'required|integer|max:1|min:0',
        ]);
    }

    public function mydelimages($category)
    {

        unlink($category->parents_category_image);
    }

// *********************************  all function********************************


    public function save_parents_category(request $request)
    {
        $this->validation($request);
        try {
            $image_info = $this->save_images($request);
            $category = $this->insert_data($request, $image_info);
            $category->save();
        } catch (Exception $e) {
            return 'not save';
        }
        return redirect('/dashboard/add/Add-parents-Category')->with('massage', 'Save successfully');
    }

    public function manage_parents_category()
    {
        $parents_category = ParentsModelCategory::all();

        return view('back_end.Parents_menu.manage_parents_menu', ['categories' => $parents_category]);
    }

    public function edit_parents_category($id)
    {
        $category = ParentsModelCategory::where('id', $id)->first();
        if ($category) {
            return view('back_end.Parents_menu.parents_edit', ['category' => $category]);

        } else {
            echo "Your category not found please try again or re enter this 'Parents category manage'";
        }

    }

    public function edit_parents_category_saved(request $request)
    {

        $this->validation($request);
        try {
            $category = ParentsModelCategory::where('id', $request->id)->first();
            if (file_exists($request->category_image)) {
                $this->mydelimages($category);
                $image_info = $this->save_images($request);
                $category = $this->insert_data($request, $image_info);
                $category->update();
                return redirect('/dashboard/manage/manage-parents-category')->with('massage', 'Category Update successful');
            } else {
                $image_info = $request->image_info;
                $category = $this->insert_data($request, $image_info);
                $category->update();
                return redirect('/dashboard/manage/manage-parents-category')->with('massage', 'Category Update successful');
            }
        } catch (Exception $e) {
            echo 'file not updated';
        }
    }

    public function status_published($id)
    {
        $category = ParentsModelCategory::where('id', $id)->first();
        $category->status = 1;
        $category->update();
        $blocks = HtmlBlocksModel::where('parents_category_id', $id)->get();
        foreach ($blocks as $block) {
            $block->status = 1;
            $block->update();
        }
        $subcategory = SubcategoryModel::where('parents_category_id', $id)->get();
        foreach ($subcategory as $del) {
            $del->status = 1;
            $del->update();
        }
        return redirect('/dashboard/manage/manage-parents-category')->with('massage', 'status Update successful');

    }

    public function status_unpublished($id)
    {
        $category = ParentsModelCategory::where('id', $id)->first();
        $category->status = 0;
        $category->update();
        $blocks = HtmlBlocksModel::where('parents_category_id', $id)->get();
        foreach ($blocks as $block) {
            $block->status = 0;
            $block->update();
        }
        $subcategory = SubcategoryModel::where('parents_category_id', $id)->get();
        foreach ($subcategory as $del) {
            $del->status = 0;
            $del->update();
        }
        return redirect('/dashboard/manage/manage-parents-category')->with('massage', 'status Update successful');
    }

    public function delete_parents_category($id)
    {

        try {
            $category = ParentsModelCategory::where('id', $id)->first();
            $this->mydelimages($category);
            $blocks = HtmlBlocksModel::where('parents_category_id', $id)->get();
            $subcategory = SubcategoryModel::where('parents_category_id', $id)->get();
            foreach ($blocks as $block) {
                $block->delete();
            }
            foreach ($subcategory as $del) {
                $del->delete();
            }
            $category->delete();
            return redirect('/dashboard/manage/manage-parents-category')->with('massage', 'category delete successful');
        } catch (Exception $e) {
            echo 'not delete';
        }

    }

}
