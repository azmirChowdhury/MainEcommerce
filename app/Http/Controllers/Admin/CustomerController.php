<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\All_districtName_division;
use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers=CustomerModel::all();
        return view('back_end.customers.all_customers',['customers'=>$customers]);
    }

    public function active_customer($id){
        $customer=CustomerModel::find($id);
        $customer->status=1;
        $customer->update();
        return redirect()->route('all_customers',['slug'=>'all-customer'])->with('massage','Customer '.$customer->last_name.' activation successful');
    }

    public function stopped_customer($id){
        $customer=CustomerModel::find($id);
        $customer->status=2;
        $customer->update();
        return redirect()->route('all_customers',['slug'=>'all-customer'])->with('massage','Customer '.$customer->last_name.' Stopped successful');
    }
    public function delete_customer($id){
        $customer=CustomerModel::find($id);
        $customer->delete();
        return redirect()->route('all_customers',['slug'=>'all-customer'])->with('massage','Customer delete successful');
    }
    public function customer_details($id){
        $customer=CustomerModel::find($id);
        $district=All_districtName_division::find($customer->district_id);
        return view('back_end.customers.customer_details_view',['customer'=>$customer,'district'=>$district]);
    }


}
