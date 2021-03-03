<?php

namespace App\Http\Controllers\front_end;

use App\Http\Controllers\Controller;
use App\Models\All_districtName_division;
use App\Models\CustomerModel;
use App\Models\Logo_BackgroundModel;
use App\Models\Password_reset_User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class LoginRegisterController extends Controller
{
    public function index()
    {
        $district = All_districtName_division::where('use_status', 0)->get();
        return view('front_end.loginRegister.loginRegister', ['districts' => $district]);
    }

    private function validation_register($request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:customer_models,email',
            'password' => 'required|min:6|max:20',
            'phone_number' => 'required|max:191',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'district_id' => 'required|integer',
            'g-recaptcha-response' => 'required',
        ]);
    }

    private function information_insert($request)
    {
        $customer = new CustomerModel();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->phone_number = $request->phone_number;
        $customer->present_address = $request->present_address;
        $customer->permanent_address = $request->permanent_address;
        $customer->district_id = $request->district_id;
        $customer->status = 0;
        $customer->created_at = Carbon::now();
        return $customer;

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
        $link = env('app_url') . 'customer/account-create-conformation' . $token . $email_url;
        return $link;
    }

    private function send_mail($link, $email)
    {
        $found = CustomerModel::where('email', $email)->where('status', 0)->first();
        if ($found != null) {
            $logo = Logo_BackgroundModel::first();
            $found['url'] .= env('app_url');
            $found['link'] .= $link;
            $found['app_name'] .= env('app_name');
            $found['date'] .= date('Y');
            $found['logo'] .= $logo->logo;
            $data = $found->toArray();
            Mail::send('front_end\loginRegister\confirm_mail_template', $data, function ($massage) use ($data) {
                $massage->to($data['email']);
                $massage->subject(env('APP_NAME') . ' New account create confirmation');
            });
        } else {
            return redirect()->back();
        }

    }

    public function resister_customer(request $request)
    {
        if (!empty($request->input('g-recaptcha-response'))) {
            try {
                $this->validation_register($request);
                $customer = $this->information_insert($request);
                $token = $this->token_Generate($request);
                $link = $this->link_generate_send($request, $token);
                $customer->save();
                $this->send_mail($link, $request->email);
                return redirect()->route('loginRegister')->with('massage', 'Account confirmation mail send your email check inbox or spam box');
            } catch (Exception $e) {
                return redirect()->back()->with('massage', 'account create failed');
            }
        } else {
            return redirect()->route('loginRegister')->with('ErrorMassage', 'reCaptcha Problem');
        }

    }

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
    private function customer_status_update($token)
    {
        $customer = CustomerModel::where('email', $token->email)->first();
        $customer->status = 1; /* 1 for account is active */
        $customer->update();
        return $customer;
    }

    public function customer_register_confirm(request $request)
    {
        $token = Password_reset_User::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if ($token != null) {
            $expire_time = $token->created_at;
            $work = $this->time_Match($expire_time);
            if ($work == 'match') {
                $customer = $this->customer_status_update($token);
                $token->delete();
                Session::put('customer_id', $customer->id);
                Session::put('customer_first_name', $customer->first_name);
                Session::put('customer_last_name', $customer->last_name);
                Session::put('customer_email', $customer->email);
                return redirect()->route('customer_dashboard');
            } else {
                $customer_expire = CustomerModel::where('email', $token->email)
                    ->where('status', 0)
                    ->first();
                $customer_expire->delete();
                $token->delete();
                return redirect()->route('loginRegister')->with('ErrorMassage', 'Link time expired please try to create a new account');
            }
        } else {
            return redirect()->route('loginRegister')->with('ErrorMassage', 'Link time expired please try to create a new account');
        }

    }

//    private function account_stopped_notLogin($customer){
//        if (Session::get('customer_id') & Session::get('customer_email')==true&&$customer==null){
//            $this->customer_logout();
//        }
//    }

    public function customer_dashboard()
    {
        $customer = CustomerModel::where('id', Session::get('customer_id'))
            ->where('status', 1)
            ->first();
        return view('front_end.loginRegister.customer_dashboard', ['customer_login' => $customer]);
    }

    public function CustomerLogin(request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!empty($request->input('g-recaptcha-response'))) {
            $customer = CustomerModel::where('email', $request->input('email'))
                ->where('status', 1)
                ->first();
            if (!empty($customer)) {
                if (password_verify($request->input('password'), $customer->password) == true && Hash::check($request->input('password'), $customer->password)) {
                    Session::put('customer_id', $customer->id);
                    Session::put('customer_first_name', $customer->first_name);
                    Session::put('customer_last_name', $customer->last_name);
                    Session::put('customer_email', $customer->email);
                    return redirect()->route('customer_dashboard');
                } else {
                    return redirect()->route('loginRegister')->with('ErrorMassage', 'Password or email not match');
                }
            } else {
                return redirect()->route('loginRegister')->with('ErrorMassage', 'Your information not match our recode');
            }
        } else {
            return redirect()->route('loginRegister')->with('ErrorMassage', 'reCaptcha Problem');
        }
    }

    public function customer_logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_first_name');
        Session::forget('customer_last_name');
        Session::forget('customer_email');
        return redirect()->route('loginRegister');
    }


    private function account_details_validation($request)
    {
        $this->validate($request, [
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($request->current_password != null) {
            $this->validate($request, [
                'current_password' => 'required|min:8',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|min:8',
            ]);
        }
    }

    private function password_and_all_change($request, $customer)
    {

        if (password_verify($request->input('current_password'), $customer->password) == true) {
            if ($request->input('new_password') == $request->input('confirm_password')) {
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->password = Hash::make($request->new_password);
                $customer->update();
            } else {
                return redirect('customer/account-dashboard')->with('AdetailsError', 'New password and confirm password not match');
            }
        }
    }

    public function change_account_details(request $request)
    {
        $this->account_details_validation($request);
        $customer = CustomerModel::where('email', $request->email)
            ->where('status', 1)
            ->first();
        if ($customer != null) {
            if ($request->current_password != null) {
                $this->password_and_all_change($request, $customer);
                return redirect('customer/account-dashboard')->with('Adetailsmassage', 'Details update successful');
            } else {
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->update();
                return redirect('customer/account-dashboard')->with('Adetailsmassage', 'Details update successful');
            }

        } else {
            return redirect('customer/account-dashboard')->with('AdetailsError', 'Current password not match');
        }
    }






}
