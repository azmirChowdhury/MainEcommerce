<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfromationModel;
use App\Models\PagesModel;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $pages = PagesModel::all();
        return view('back_end.pages.manage_page', ['pages' => $pages]);
    }

    public function add_page()
    {
        return view('back_end.pages.create_new_page');
    }

    private function validation($request)
    {
        $this->validate($request, [
            'page_name' => 'required|max:255',
            'collum_id' => 'required|integer',
            'description' => 'required',
            'status' => 'required|integer|min:0|max:1',
        ]);
        if (!empty($request->id)==true){
            $this->validate($request, [
                'id' =>'required|integer',
            ]);
        }
    }

    private function information_insert($request, $work)
    {
        if ($work == 'i') {
            $pages = new PagesModel();
        } else {
            $pages = PagesModel::find($request->id);
        }
        $pages->page_name=$request->page_name;
        $pages->collum_id= $request->collum_id;
        $pages->description = $request->description;
        $pages->status = $request->status;
        return $pages;
    }

    public function save_page(request $request)
    {
        $this->validation($request);
        $pages = $this->information_insert($request, 'i');
        $pages->save();
        return redirect('/dashboard/pages/pages-create-new-add')->with('massage', 'New page  save successful');
    }

    public function edit_page($id)
    {
        $pages = PagesModel::find($id);
        if ($pages!=null){
            return view('back_end.pages.edit_page', ['page' => $pages]);
        }else{
            return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page was deleted');
        }
    }

    public function save_edit_page(request $request)
    {
        $this->validation($request);
        $pages = PagesModel::find($request->id);
        if ($pages!=null){
            $pages = $this->information_insert($request, 'u');
            $pages->update();
        }else{
            return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page was deleted');
        }
        return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page Update successful');
    }

    public function page_publish($id)
    {
        $pages=PagesModel::find($id);
        if ($pages!=null){
            $pages->status=1;
            $pages->update();
        }else{
            return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page was deleted');
        }
        return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page  status publish successful');
    }
    public function page_unpublished($id)
    {
        $pages=PagesModel::find($id);
        if ($pages!=null){
            $pages->status=0;
            $pages->update();
        }else{
            return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page was deleted');
        }
        return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page  status unpublished successful');
    }
    public function page_delete($id)
    {
        $pages=PagesModel::find($id);
        if ($pages!=null){
        }else{
            return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page already delete');
        }
        $pages->delete();
        return redirect('/dashboard/pages/pages-create-manage')->with('massage', 'Page  delete successful');
    }


}
