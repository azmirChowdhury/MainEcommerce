<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ColorModel;
use App\Models\admin\SizeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\DeleteFunction\Product_Color_Delete_Comtroller;

class ColorController extends Controller
{
    public function index()
    {
        $color = ColorModel::all();
        return view('back_end.color.color_manage', ['colors' => $color]);
    }

    public function color_edit_view($id)
    {
        $color = ColorModel::find($id);
        return view('back_end.color.edit_color',['color' => $color]);
    }

    public function color_add_view()
    {
        return view('back_end.color.add_color');
    }

    public function color_save(request $request)
    {
        $this->validate($request, [
            'color_name' => 'required',
            'color' => 'required',
        ]);
        $color = new ColorModel();
        $color->color_name = $request->color_name;
        $color->color = $request->color;
        $color->save();
        return redirect('/dashboard/color/add/view')->with('massage', 'Color save successful');

    }

    public function update_color(request $request)
    {
        $this->validate($request, [
            'color_name' => 'required',
            'color' => 'required',
            'id' => 'required|integer',
        ]);
        $color = ColorModel::find($request->id);
        $color->color_name=$request->color_name;
        $color->color=$request->color;
        $color->update();
        return redirect('/dashboard/size&color/color-manage')->with('massage', 'Color update successful');
    }

    public function delete_color($id)
    {
//        $color = ColorModel::find($id);
//        $color->delete();
        app(Product_Color_Delete_Comtroller::class)->colorDelete($id);
        return redirect('/dashboard/size&color/color-manage')->with('massage', 'Size delete successful');

    }
}
