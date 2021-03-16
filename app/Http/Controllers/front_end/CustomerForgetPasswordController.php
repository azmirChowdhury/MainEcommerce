<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\Logo_BackgroundModel;
use App\Models\Password_reset_User;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use Session;

class CustomerForgetPasswordController extends Controller
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
        if ($ey == $ny && $em == $nm && $ew == $nw && $emi->minute > $nmi) {
            return $work = 'match';
        } else {
            return $work = 'not match';
        }

    }
    
    public function index()
    {
        try {
            $expire_user=Password_reset_User::all();
            foreach ($expire_user as $user){
                $time=$user->created_at;
                $work=$this->time_Match($time);
                if ($work!='match'){
                    $user->delete();
                }
            }
        }catch (Exception $exception){
            return redirect('/');
        }

        return view('front_end.loginRegister.password_reset.customer_password_reset');
    }


    private function token_Generate($request)
    {
        $_token = str_random(40);
        $has_token = Password_reset_User::where('email', $request->email)->first();
        if (!$has_token == null){
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
        $link = env('app_url') . 'customer-password-reset' . $token . $email_url;
        return $link;
    }


    private function send_mail($request, $found)
    {

        $token = $this->token_Generate($request);
        $link = $this->link_generate_send($request, $token);
        $logo = Logo_BackgroundModel::first();
        $found['url'] .= env('app_url');
        $found['link'] .= $link;
        $found['app_name'] .= env('app_name');
        $found['date'] .= date('Y');
        $found['logo'] .= $logo->logo;
        $data = $found->toArray();
        Mail::send('front_end/loginRegister/password_reset/customer_password_reset_mail_template', $data, function ($massage) use ($data) {
            $massage->to($data['email']);
            $massage->subject(env('APP_NAME') . 'User password resets confirmation');
        });
    }


    public function reset_request(request $request)
    {
        if (!empty($request->input('g-recaptcha-response'))) {

            $this->validate($request, [
                'email' => 'required|email',
                'g-recaptcha-response' => 'required',
            ]);

            try {

                $found = CustomerModel::where('email', $request->input('email'))
                    ->where('status',1)
                    ->first();
                if (!$found == null) {
                    $this->send_mail($request, $found);
                    return redirect('Customer-password-reset')->with('massage', 'User request send to the email check Inbox or Spam');
                } else {
                    return redirect('Customer-password-reset')->with('ErrorMassage', 'User not found in our recode');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            return redirect('Customer-password-reset')->with('ErrorMassage', 'Please complete reCaptcha ');
        }

    }


    public function new_password_set(Request $request, $token)
    {

        $db_token = Password_reset_User::where('token', $token)
            ->where('email', $request->email)
            ->first();

        if (empty($db_token) == false) {
            $expire_time = $db_token->created_at;
            $work = $this->time_Match($expire_time);
            if ($work == 'match') {
                $user = CustomerModel::where('email', $request->email)
                    ->where('status', 1)
                    ->first();
                if ($user!=null){
                    Session::put('reset_email', $user->email);
                    Session::put('reset_id', $user->id);
                    return view('front_end.loginRegister.password_reset.customer_set_password', ['email' => $request->email]);
                }else{
                    Session()->invalidate();
                    return redirect('/');
                }
              } else {
                return redirect('Customer-password-reset')->with('ErrorMassage', 'Time out ! The link has expired try again');
            }
        } else {
            return redirect('Customer-password-reset')->with('ErrorMassage', 'The link has expired try again');
        }
    }

    public function new_password_set_save(request $request)
    {
        if (empty($request->input('g-recaptcha-response'))){
          return redirect()->back()->with('ErrorMassage','reCaptcha not complete');
          exit();
        }
        $expire_user = Password_reset_User::where('email', $request->email)->first();
        $work = $this->time_Match($expire_user->created_at);

        if ($work == 'match' && $expire_user != null) {

            $this->validate($request, [
                'new_password' => 'required|min:8',
                'confirm_password' => 'required',
                'email' => 'required',
            ]);
            if ($request->new_password == $request->confirm_password) {
                if ($request->email == Session::get('reset_email')) {
                    $user = CustomerModel::where('email', $request->email)
                        ->where('status', 1)
                        ->first();
                    if ($user != null) {
                        $tokan = Password_reset_User::where('email', $request->email)->first();
                        $tokan->delete();
                        $user->password = Hash::make($request->new_password);
                        Session::forget('reset_email');
                        Session::forget('reset_id');
                        $user->update();
                        Session::put('customer_id', $user->id);
                        Session::put('customer_first_name', $user->first_name);
                        Session::put('customer_last_name', $user->last_name);
                        Session::put('customer_email', $user->email);
                        return redirect()->route('customer_dashboard');
                    } else {
                        return redirect('Customer-password-reset')->with('ErrorMassage', 'User not found');
                    }
                } else {
                    Session::forget('reset_email');
                    Session::forget('reset_id');
                    echo 'user session not match';
                }

            } else {
                return redirect()->back()->with('ErrorMassage','confirm password and new password not match try again');
            }
        } else {
            return redirect()->route('customer_password_reset_show')->with('ErrorMassage','Time expire ! try again');
        }
    }


}
