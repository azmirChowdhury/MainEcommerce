<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HtmlBlocksModel;
use App\Models\ParentsModelCategory;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use DB;

class ParentsMenuBlocksController extends Controller
{
    public function index()
    {
        $blocks = DB::table('html_blocks_models')
            ->join('parents_model_categories', 'parents_model_categories.id', '=', 'html_blocks_models.parents_category_id')
            ->select('parents_model_categories.*', 'html_blocks_models.*')
            ->get();
        return view('back_end.html_blocks.manage_html_blocks', ['blocks_in' => $blocks]);

    }


    private function validation($request)
    {
        $request->validate([
            'laval_name' => 'required|max:40',
            'parent_category_id' => 'required|integer',
            'status' => 'required|max:1|min:0|integer',
        ]);
    }

    private function insert_data($request, $idintify)
    {
        if ($idintify == 'i') {
            $blocks = new HtmlBlocksModel();

        } else {
            $blocks = HtmlBlocksModel::where('id', $request->id)->first();
        }

        $blocks->laval_name = $request->laval_name;
//        $blocks->for_blocks = 2;
        $blocks->parents_category_id = $request->parent_category_id;
        $blocks->status = $request->status;
        return $blocks;
    }


    public function parents_menu_blocks_add()
    {
        $category = ParentsModelCategory::where('status', 1)->get();

        return view('back_end.html_blocks.parents_category_add_blocks', ['categories' => $category]);
    }

    public function parents_menu_blocks_save(request $request)
    {
        try {
            $this->validation($request);
            $idintify = 'i';
            $blocks = $this->insert_data($request, $idintify);
            $blocks->save();
            return redirect('/dashboard/html-blocks/parents-category-blocks-add')->with('massage', $request->laval_name . ' ' . "Collum save successfully");

        } catch (Exception $e) {
            echo 'not save sumthing wrong';
        }

    }

    public function edit_blocks($id)
    {
        $category = ParentsModelCategory::where('status', 1)->get();
        $blocks = HtmlBlocksModel::where('id', $id)->first();
        if ($blocks != null) {
            return view('back_end.html_blocks.edit_parents_category_html_blocks', ['categories' => $category, 'block' => $blocks]);
        } else {
            return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum was deleted');
        }

    }

    public function edit_blocks_save(request $request)
    {
        try {
            $this->validation($request);
            $idintify = 'e';
            $block = HtmlBlocksModel::where('id', $request->id)->first();
            if ($block!=null) {
                $blocks = $this->insert_data($request, $idintify);
                $blocks->update();
            } else {
                return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum was deleted');
            }

            return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum update successfully');
        } catch (Exception $e) {
            echo 'not save problem';
        }
    }

    public
    function status_publish($id)
    {
        $block = HtmlBlocksModel::where('id', $id)->first();
        if ($block!=null){
            $block->status = 1;
            $block->update();
        }else{
            return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum was deleted');
        }

        return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Status update successfully');
    }

    public
    function status_unpublished($id)
    {
        $block = HtmlBlocksModel::where('id', $id)->first();
        if ($block!=null){
            $block->status = 0;
            $block->update();
        }else{
            return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum was deleted');
        }
        return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Status update successfully');
    }

    public
    function delete_block($id)
    {
        $block = HtmlBlocksModel::where('id', $id)->first();
        if ($block!=null){
        $subcategory = SubcategoryModel::where('collum_id', $block->id)->get();
        foreach ($subcategory as $category) {
            $category->delete();
        }
        $block->delete();
        }else{
            return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum already deleted');
        }
        return redirect('/dashboard/html-blocks/parents-category-blocks')->with('massage', 'Collum delete successfully');
    }

}
