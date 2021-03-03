<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMassageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('back_end.email.index');
    }

    private function message_reply_status_change($request)
    {
        if ($request->type != 'mail') {
            $message = ContactMassageModel::find($request->type);
            $message->status =2;
            $message->update();
        }

    }

    public function send_mail(request $request)
    {
        $this->validate($request, [
            'to_mail' => 'required|email',
            'subject' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);
        $info['app_name'] = env('APP_NAME');
        $info['url'] = env('APP_URL');
        $info['date'] = date('Y');
        $data = $info;
        $data += $request->toArray();
        Mail::send('back_end.email.mail_body', $data, function ($massage) use ($data) {
            $massage->to($data['to_mail']);
            $massage->subject($data['subject']);
        });
        if ($request->type!='mail'){
            $this->message_reply_status_change($request);
            return redirect()->route('inbox_massage')->with('massage', 'Your replay mail send successful');
        }else{
            return redirect()->back()->with('massage', 'Your mail send successful');
        }

    }
}
