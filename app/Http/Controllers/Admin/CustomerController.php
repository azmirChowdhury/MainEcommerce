<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers=CustomerModel::all();
        return view('back_end.customers.all_customers',['customers'=>$customers]);
    }
}
