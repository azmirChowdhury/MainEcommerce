<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\admin\deletefunction\BannerDelete;
use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\HtmlBlocksModel;
use App\Models\ParentsModelCategory;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;

use DB;

class SubCategoryController extends Controller
{
    public function index()
    {
        $parents_category = ParentsModelCategory::where('status', 1)->get();
        return view('back_end.sub_category.sub_category_add', ['categories' => $parents_category]);
    }

    private function validation($request)
    {
        $request->validate([
            'category_name' => 'required|max:50',
            'parent_category_id' => 'required|integer',
            'collum_id' => 'required|integer',
            'status' => 'required|max:1',

        ]);
    }

    private function product_subcategory_change($model,$request){
        $products=ProductModel::where('category_name',$model->category_name)->get();
        foreach ($products as $product){
            $product->category_name=$request->category_name;
            $product->update();
        }
    }

    private function insert_data($request, $info)
    {
        if ($info == 'i') {
            $model=SubcategoryModel::all();
            $slug=app(slug_controller\SluConfier::class)->for_insert_slug($request->category_name,$model);
            $category = new SubcategoryModel();
        } else {
            $category = SubcategoryModel::find($request->id);
            $this->product_subcategory_change($category,$request);
            $slug=app(slug_controller\SluConfier::class)->slug_Create($request->category_name,$category);
        }
        $category->category_name =str_replace('-',' ',$request->category_name);
        $category->parents_category_id = $request->parent_category_id;
        $category->status = $request->status;
        $category->slug =$slug;
        $category->collum_id = $request->collum_id;
        return $category;
    }

// ********************************************************************************
    public function ajax_blocks_load()
    {
        $id = $_GET['id'];
        $category = HtmlBlocksModel::where('parents_category_id', $id)->where('status', 1)->get();

        foreach ($category as $data) {
            echo "<option value='$data->id'>$data->laval_name</option>";
        }
        return "<option selected> ---- Select collum ---- </option>";
    }

    public function sub_category_save(Request $request)
    {
        try {
            $this->validation($request);
            $info = 'i';
            $category = $this->insert_data($request, $info);
            if ($category->save()) {
                return redirect('/dashboard/category/subcategory')->with('massage', 'Subcategory save successful');
            } else {
                return redirect('/dashboard/category/subcategory')->with('errors', 'Subcategory not save');
            }
        } catch (Exception $e) {
            return redirect('/dashboard/category/subcategory')->with('errors', 'Subcategory not save');

        }


    }

    public function manage_subcategory()
    {
        $subcategory = DB::table('subcategory_models')
            ->join('parents_model_categories', 'parents_model_categories.id', '=', 'subcategory_models.parents_category_id')
            ->join('html_blocks_models', 'html_blocks_models.id', '=', 'subcategory_models.collum_id')
            ->select('subcategory_models.*', 'html_blocks_models.laval_name', 'parents_model_categories.parents_category_name')
            ->get();
        return view('back_end.sub_category.manage_sub_category', ['subcategories' => $subcategory]);
    }

    public function publish_status($id)
    {
        $category = SubcategoryModel::find($id);
        $category->status = 1;
        $category->update();
        return redirect('/dashboard/category/subcategory/manage')->with('massage', 'update successful');
    }

    public function unpublished_status($id)
    {
        $category = SubcategoryModel::find($id);
        $category->status = 0;
        $category->update();
        return redirect('/dashboard/category/subcategory/manage')->with('massage', 'update successful');
    }

    public function edit_subcategory($id)
    {
        $subcategory = SubcategoryModel::find($id);
        $parents = ParentsModelCategory::where('status', 1)->get();
        $blocks = HtmlBlocksModel::all();
        return view('back_end.sub_category.edit_sub_category', ['subcategory' => $subcategory, 'parents' => $parents, 'collums' => $blocks]);
    }

    public function edit_sub_category_save(request $request)
    {
        try {
            $this->validation($request);
            $info = 'u';
            $category = $this->insert_data($request, $info);
            if ($category->update()) {
                return redirect('/dashboard/category/subcategory/manage')->with('massage', 'Subcategory update successful');
            } else {
                return redirect('/dashboard/category/subcategory/manage')->with('err', 'Subcategory not update');
            }
        } catch (Exception $e) {
            return redirect('/dashboard/category/subcategory/manage')->with('err', 'Subcategory not save');

        }

    }

    public function delete_subcategory($id){
        $category=SubcategoryModel::find($id);
        $banners=BannerModel::where('category_id',$category->id)->get();
        foreach ($banners as $banner){
            app(BannerDelete::class)->banner_delete_function($banner->id);
        }
        if($category->delete()){
            return redirect('/dashboard/category/subcategory/manage')->with('massage', 'Subcategory Delete successful');
        }else{
            return redirect('/dashboard/category/subcategory/manage')->with('err', 'Subcategory not delete');
        }

    }
    public function add_feature_product(request $request){
        $this->validate($request,[
            'afp_id'=>'required|integer'
        ]);
        $category=SubcategoryModel::find($request->afp_id);
        if ($category!=null){
            $category->feature_product=$category->feature_product==0?1:0;
            $category->update();
        }
        return redirect()->route('manage_subcategory');
    }

}
