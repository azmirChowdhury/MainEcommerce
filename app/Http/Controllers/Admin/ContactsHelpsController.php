<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfromationModel;
use Illuminate\Http\Request;
use App\Models\SocialIconModel;
use function GuzzleHttp\Promise\all;

class ContactsHelpsController extends Controller
{
    public function index()
    {
        $contacts = ContactInfromationModel::all();
        return view('back_end.contact_help.manage_contact', ['contacts' => $contacts]);
    }

    public function add_contact()
    {
        return view('back_end.contact_help.add_contact');
    }

    private function validation($request)
    {
        $this->validate($request, [
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
            $contacts = new ContactInfromationModel();
        } else {
            $contacts = ContactInfromationModel::find($request->id);
        }
        $contacts->email =$request->email;
        $contacts->phone_number= $request->phone_number;
        $contacts->telephone_number = $request->telephone_number;
        $contacts->fax = $request->fax;
        $contacts->address =$request->address;
        $contacts->status = $request->status;
        return $contacts;
    }

    public function save_contact(request $request)
    {
            $this->validation($request);
            $contacts = $this->information_insert($request, 'i');
            $contacts->save();
        return redirect('/dashboard/utilities/contacts-help-manage')->with('massage', 'New contacts  save successful');
    }

    public function edit_contact($id)
    {
        $contacts = ContactInfromationModel::find($id);
        return view('back_end.contact_help.edit_contact', ['contact' => $contacts]);
    }

    public function save_edit_contact(request $request)
    {
        $this->validation($request);
        $contacts = $this->information_insert($request, 'u');
        $contacts->update();
        return redirect('/dashboard/utilities/contacts-help-manage')->with('massage', 'Contacts Update successful');
    }

    public function contact_publish($id)
    {
        $contacts=ContactInfromationModel::find($id);
        $contacts->status=1;
        $contacts->update();
        return redirect('/dashboard/utilities/contacts-help-manage')->with('massage', 'Contacts  status publish successful');
    }
    public function contact_unpublished($id)
    {
        $contacts=ContactInfromationModel::find($id);
        $contacts->status=0;
        $contacts->update();
        return redirect('/dashboard/utilities/contacts-help-manage')->with('massage', 'Contacts  status unpublished successful');
    }
    public function contact_delete($id)
    {
        $contacts=ContactInfromationModel::find($id);
        $contacts->delete();
        return redirect('/dashboard/utilities/contacts-help-manage')->with('massage', 'Contacts  delete successful');
    }


}
