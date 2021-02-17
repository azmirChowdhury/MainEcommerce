<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Password_reset_User;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Session;
use Str;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    private function time_Match($expire_date)
    {
        $current_date = Carbon::now();
        $ey = $expire_date->year;
        $em = $expire_date->month;
        $ew = $expire_date->week;
        $emi = $expire_date->addMinute(6);
        $es = $expire_date->second;

        $ny = $current_date->year;
        $nm = $current_date->month;
        $nw = $current_date->week;
        $nmi = $current_date->minute;
        $ns = $current_date->second;
        if ($ey==$ny&&$em==$nm&&$ew==$nw&&$emi->minute>$nmi){
            return $work='match';
        }else{
            return $work='not match';
        }

    }

    public function index()
    {
        $expire_user=Password_reset_User::all();
        foreach ($expire_user as $user){
            $time=$user->created_at;
            $work=$this->time_Match($time);
            if ($work!='match'){
                $user->delete();
            }
        }
        return view('back_end.user.password_reset.reset_password_view');
    }

    private function token_Generate($request)
    {
        $_token = str_random(40);
        $has_token = Password_reset_User::where('email', $request->email)->first();
        if (!$has_token == null) {
            $has_token->delete();
        }
        $token = new Password_reset_User();
        $token->email = $request->email;
        $token->token = $_token;
        $token->created_at = Carbon::now();
        $token->save();
        return $token->token;
    }

    private function link_generate_send($request, $token)
    {
        $email_url = '?email=' . $request->email;
        $link = env('app_url') . 'User/admin-password-reset' . $token . $email_url;
        return $link;
    }

    public function reset_request(request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        try {

            $found = User::where('email', $request->email)->first();
            if (!$found == null) {
                $token = $this->token_Generate($request);
                $link = $this->link_generate_send($request, $token);
                $found['link'] .= $link;
                $found['url'] .= env('app_url');
                $found['app_name'] .= env('app_name');
                $found['date'] .= date('Y');
                $data = $found->toArray();
                Mail::send('back_end.user.mail_body.email_body', $data, function ($massage) use ($data) {
                    $massage->to($data['email']);
                    $massage->subject(env('APP_NAME') . ' User password resets confirmation');
                });

                return redirect('admin/main-admin-manage-admin')->with('massage', 'User request send to the email check Inbox or Spam');
            } else {
                return redirect('User/admin-password-reset')->with('massage', 'User not found in our recode');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }



    public function new_password_set(Request $request, $token)
    {

        $db_token = Password_reset_User::where('token', $token)
            ->where('email', $request->email)
            ->first();

        if (empty($db_token)==false) {
            $expire_time=$db_token->created_at;
            $work=$this->time_Match($expire_time);
            if ($work=='match'){
                $user = User::where('email', $request->email)->first();
                Session::put('reset_email', $user->email);
                Session::put('reset_id', $user->id);
                return view('back_end.user.password_reset.set_new_password', ['email' => $request->email]);
            }else{
                return redirect('User/admin-password-reset')->with('massage', 'Time out ! The link has expired try again');
            }
        } else {
            return redirect('User/admin-password-reset')->with('massage', 'The link has expired try again');
        }
    }



    public function new_password_set_save(request $request)
    {
        $expire_user = Password_reset_User::where('email', $request->email)->first();
        $work = $this->time_Match($expire_user->created_at);

        if ($work == 'match'&&$expire_user!=null) {


            $this->validate($request, [
                'new_password' => 'required|min:8',
                'confirm_password' => 'required',
                'email' => 'required',
            ]);
            if ($request->new_password == $request->confirm_password) {
                if ($request->email == Session::get('reset_email')) {
                    $user = User::where('email', $request->email)->first();
                    if ($user != null) {
                        $tokan = Password_reset_User::where('email', $request->email)->first();
                        $tokan->delete();
                        $user->password = Hash::make($request->new_password);
                        Session::forget('reset_email');
                        Session::forget('reset_id');
                        $user->update();
                        return redirect('admin/main-admin-manage-admin')->with('massage', $user->email . ' password reset successful');
                    } else {
                        echo 'user no found';
                    }
                } else {
                    Session::forget('reset_email');
                    Session::forget('reset_id');
                    echo 'user session not match';
                }

            } else {
                return redirect()->back()->with('confirm password and new password not match try again');
            }
        }else{
            return redirect()->back()->with('Time expire ! try again');
        }
    }
}
