<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Password_reset_User;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Session;
use Str;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    public function index()
    {
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
            $request->call(function () {
                Password_reset_User::where('created_at','<',Carbon::now()->subMinutes(1.0)->toDateTimeString())->delete();
            });
            return redirect('admin/main-admin-manage-admin')->with('massage', 'User request send to the email check Inbox or Spam');
        } else {
            return redirect('User/admin-password-reset')->with('massage', 'User not found in our recode');
        }

    }

    public function new_password_set(Request $request, $token)
    {

        $db_token = Password_reset_User::where('token', $token)
            ->where('email', $request->email)
            ->first();
        if ($db_token == null) {
            return redirect('User/admin-password-reset')->with('massage', 'The link has expired try again');
        } else {
            $user=User::where('email',$request->email)->first();
            Session::put('reset_email',$user->email);
            Session::put('reset_id',$user->id);
            return view('back_end.user.password_reset.set_new_password',['email'=>$request->email]);
        }
    }

    public function new_password_set_save(request $request)
    {
        $this->validate($request,[
            'new_password'=>'required|min:8',
            'confirm_password'=>'required',
            'email'=>'required',
        ]);
        if ($request->new_password==$request->confirm_password){
            if ($request->email==Session::get('reset_email')){
                $user=User::where('email',$request->email)->first();
                if ($user!=null){
                    $tokan=Password_reset_User::where('email',$request->email)->first();
                    $tokan->delete();
                    $user->password=Hash::make($request->new_password);
                    Session::forget('reset_email');
                    Session::forget('reset_id');
                    $user->update();
                    return redirect('admin/main-admin-manage-admin')->with('massage',$user->email.' password reset successful');
                }else{
                    echo 'user no found';
                }
            }else{
                Session::forget('reset_email');
                Session::forget('reset_id');
                echo 'user session not match';
            }

        }else{
            return redirect()->back()->with('confirm password and new password not match try again');
        }
    }
}
