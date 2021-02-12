<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    public function admin404(){

        return view('back_end.errors.error404');
    }
}
