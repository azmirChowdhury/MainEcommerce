<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\SizeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\DeleteFunction\ProductSizeDeleteController;

class SizeController extends Controller
{
    public function index()
    {
        $size = SizeModel::all();
        return view('back_end.size_manage.manage_size', ['sizes' => $size]);
    }

    public function size_add_view()
    {
        return view('back_end.size_manage.add_size');
    }

    public function size_save(request $request)
    {
        $this->validate($request, [
            'size_name' => 'required'
        ]);
        $size = new SizeModel();
        $size->Size = $request->size_name;
        $size->save();
        return redirect('/dashboard/size/add/view')->with('massage', 'Size save successful');

    }

    public function update_size(request $request)
    {
        $this->validate($request, [
            'size_name' => 'required',
            'id' => 'required|integer'
        ]);
        $size = SizeModel::find($request->id);
        $size->Size = $request->size_value;
        $size->update();
        return redirect('/dashboard/size&color/size-manage')->with('massage', 'Size Update successful');
    }

    public function delete_size($id)
    {
        app(ProductSizeDeleteController::class)->deleteSize($id);
//        $size = SizeModel::find($id);
//        $size->delete();
        return redirect('/dashboard/size&color/size-manage')->with('massage', 'Size delete successful');

    }

}
