<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\All_districtName_division;
use App\Models\NotesModel;

use Illuminate\Http\Request;

class NotesController extends Controller
{

    private function notes_validation($request)
    {
        $this->validate($request, [
            'role' => 'required|integer',
            'description' => 'required',
            'status' => 'required|integer|min:0|max:1',
        ]);
    }


    private function insert_notes_info($request,$work)
    {
        if ($work == 'i') {
            $notes= new NotesModel();
        } else {
            $notes= NotesModel::find($request->id);
        }
        $notes->role=$request->role;
        $notes->description = $request->description;;
        $notes->status = $request->status;
        return $notes;
    }

    public function notes_save(request $request)
    {
        $this->notes_validation($request);
        $notes=$this->insert_notes_info($request,'i');
        $notes->save();
        return redirect()->back()->with('massage','Note save successful');
    }

    public function edit_notes($id){

        $notes=NotesModel::find($id);
        if ($notes!=null){
            return view('back_end.purchase_settings.notes_edit',['note'=>$notes]);
        }else{
            return redirect()->back()->with('massage','notes was deleted');

        }
    }

    public function notes_edit_save(request $request)
    {
        $this->notes_validation($request);
        $notes= NotesModel::find($request->id);
        if ($notes!=null){
            $notes=$this->insert_notes_info($request, 'u');
            $notes->update();
        }else{
            return redirect()->back()->with('massage','notes was deleted');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage','Notes update successful');
    }

    public function delete_notes($id){
        $note=NotesModel::find($id);;
        if ($note!=null){
            $note->delete();
        }else{
            return redirect()->back()->with('massage',' note already deleted');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage','Notes delete successful');
    }
    public function publish_notes($id){
        $notes=NotesModel::find($id);
        if ($notes!=null){
            $notes->status=1;
            $notes->update();
        }else{
            return redirect()->back()->with('massage','notes was deleted');

        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage','Notes status Published successful');
    }
    public function unpublished_notes($id){
        $notes=NotesModel::find($id);
        if ($notes!=null){
            $notes->status=0;
            $notes->update();
        }else{
            return redirect()->back()->with('massage','notes was deleted');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage','Notes status Unpublished successful');
    }
}
