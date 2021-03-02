<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\ContactMassageModel;
use Illuminate\Http\Request;
use Session;

class ContactsController extends Controller
{
    public function index(){

        return view('front_end.contact_us.contact_us');
    }

    private function validation($request){
        $this->validate($request,[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'subject'=>'required|max:191',
            'massage'=>'required',
        ]);
    }
    private function insert_massage($request){
        $massage=new ContactMassageModel();
        $massage->name=$request->input('name');
        $massage->email=$request->input('email');
        $massage->subject=$request->input('subject');
        $massage->massage=$request->input('massage');
        $massage->status=0;
        return $massage;
    }

  public function send_massage(request $request){
//        if (!empty($request->input('g-recaptcha-response'))){
            $this->validation($request);
            $massage=$this->insert_massage($request);
            $massage->save();
            return redirect(env('app_name').'-contacts-us')->with('massage','massage send successful');
//        }else{
//            return redirect(env('app_name').'-contacts-us')->with('ErrorMassage','massage send failed because you are not complete reCaptcha');
//        }
  }


}
