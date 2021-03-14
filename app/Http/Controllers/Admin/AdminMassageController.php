<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\All_notifications;
use App\Models\ContactMassageModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminMassageController extends Controller
{
    public function index()
    {
        $message = ContactMassageModel::orderBy('id', 'desc')
            ->get();
        return view('back_end.massage.manage_massage', ['messages' => $message]);
    }

    public function full_view_message($name, $id)
    {
        $message = ContactMassageModel::find($id);
        if ($message!=null){
            $message->status = $message->status == 2 ? 2 : 1;
            $message->update();
            $this->delete_notification($message);
        }else{
            return redirect()->back()->with('massage', 'Message was deleted');
        }
        return view('back_end.massage.full_massage_view', ['message' => $message]);
    }

    public function message_reply($email, $id)
    {
        return view('back_end.massage.reply_mail', ['email' => $email, 'id' => $id]);
    }

    private function delete_notification($request)
    {
        $notification = All_notifications::where('notifiable_id',$request->id)->first();
        if ($notification!=null){
            $notification->delete();
        }
    }

    public function delete_message(request $request)
    {
//        $this->validate($request,[
//           'Select_message'=>'required'
//        ]);
        if ($request->Select_message != null) {

            foreach ($request->Select_message as $id) {
                $message = ContactMassageModel::find($id);
                if ($message != null) {
                    $this->delete_notification($message);
                    $message->delete();
                } else {
                    return redirect()->back()->with('massage', 'Message already deleted');
                }
            }
            return redirect()->back()->with('massage', 'Message delete successful');
        } else {
            return redirect()->back()->with('err', 'Delete failed ! Please select a message');
        }
    }
}
