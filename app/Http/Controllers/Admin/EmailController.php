<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(){
        return view('back_end.email.inbox');
    }

    public function email_compose(){
        return view('back_end.email.mail_compose');
    }
}
