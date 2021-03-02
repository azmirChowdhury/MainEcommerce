<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMassageModel;
use Illuminate\Http\Request;

class AdminMassageController extends Controller
{
    public function index(){
        $message=ContactMassageModel::orderBy('id','desc')
            ->get();
        return view('back_end.massage.manage_massage',['messages'=>$message]);
    }
    public function full_view_message($name,$id){
       $message=ContactMassageModel::find($id);
       $message->status=$message->status==2?2:1;
       $message->update();
       return view('back_end.massage.full_massage_view',['message'=>$message]);
    }
    public function message_reply($email,$id){
        return view('back_end.email.index',['email'=>$email,'id'=>$id]);
    }

    public function delete_message(request $request){
//        $this->validate($request,[
//           'Select_message'=>'required'
//        ]);
        if ($request->Select_message!=null) {

            foreach ($request->Select_message as $id) {
                $message = ContactMassageModel::find($id);
                $message->delete();
            }
            return redirect()->back()->with('massage','Message delete successful');
        }else{
            return redirect()->back()->with('err','Delete failed ! Please select a message');
        }
    }
}
