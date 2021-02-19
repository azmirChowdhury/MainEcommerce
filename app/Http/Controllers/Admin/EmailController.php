<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('back_end.email.index');
    }


    public function send_mail(request $request)
    {
        $this->validate($request, [
            'to_mail'=>'required|email',
            'subject'=>'required',
            'description'=>'required',
        ]);

        $info['app_name'] = env('APP_NAME');
        $info['url'] = env('APP_URL');
        $info['date'] = date('Y');
        $data=$info;
        $data += $request->toArray();
        Mail::send('back_end.email.mail_body', $data, function ($massage) use ($data) {
            $massage->to($data['to_mail']);
            $massage->subject($data['subject']);
        });
        return redirect()->back()->with('massage','Your mail send successful') ;
    }
}
