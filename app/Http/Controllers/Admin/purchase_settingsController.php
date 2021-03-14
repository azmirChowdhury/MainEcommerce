<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\All_districtName_division;
use App\Models\NotesModel;
use App\Models\PurchaseSettingsPaymentMethod;
use App\Models\ShippingDistrictModel;
use App\Models\TaxModel;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use DB;

class purchase_settingsController extends Controller
{
    public function index()
    {
        $data['payment_method'] = PurchaseSettingsPaymentMethod::all();
        $note = NotesModel::all();
        $tax = TaxModel::first();
        $shipping = ShippingDistrictModel::all();
        $district = All_districtName_division::where('use_status', 0)->get();
        return view('back_end.purchase_settings.purchase_settings_add', ['shipping' => $shipping, 'districts' => $district, 'data' => $data, 'notes' => $note, 'tax' => $tax]);
    }

    private function shipping_validation($request)
    {
        $this->validate($request, [
            'district' => 'required',
            'shipping_cost' => 'required|integer',
            'use' => 'required|integer|min:1|max:2',
            'status' => 'required|integer|min:0|max:1',
        ]);
    }

    private function district_use_status_change($distrcts, $work)
    {
        if ($work == 'use') {
            $status = 1;
        } else {
            $status = 0;
        }
        foreach ($distrcts as $district) {
            $all_district = All_districtName_division::where('district_name', $district)->first();
            $all_district->use_status = $status;
            $all_district->update();
        }
    }

    private function insert_shipping_info($request, $work)
    {
        if ($work == 'i') {
            $shipping = new ShippingDistrictModel();
            $this->district_use_status_change($request->district, 'use');
        } else {
            $shipping = ShippingDistrictModel::find($request->id);
            $this->district_use_status_change(json_decode($shipping->district_name), 'unused');
            $this->district_use_status_change($request->district, 'use');

        }
        $shipping->district_name = json_encode($request->district);
        $shipping->shipping_cost = $request->shipping_cost;
        $shipping->use = $request->use;
        $shipping->status = $request->status;
        return $shipping;

    }

    public function shipping_save(request $request)
    {
        $this->shipping_validation($request);
        $shipping = $this->insert_shipping_info($request, 'i');
        $shipping->save();
        return redirect()->back()->with('massage', 'Shipping save successful');
    }

    public function edit_shipping($id)
    {

        $shipping = ShippingDistrictModel::find($id);
        if ($shipping != null) {
            $district = All_districtName_division::where('use_status', 0)->get();
            return view('back_end.purchase_settings.edit_shipping_settings', ['districts' => $district, 'shipping' => $shipping]);
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping was deleted');

        }
    }

    public function shipping_edit_save(request $request)
    {
        $this->shipping_validation($request);
        $shipping = ShippingDistrictModel::find($request->id);
        if ($shipping != null) {
            $shipping = $this->insert_shipping_info($request, 'u');
            $shipping->update();
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping update successful');
    }

    public function delete_shipping($id)
    {
        $district = ShippingDistrictModel::find($id);
        if ($district != null) {
            $districts = json_decode($district->district_name);
            $this->district_use_status_change($districts, 'unused');
            $district->delete();
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping was delete');
        }

        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping delete successful');
    }

    public function publish_shipping($id)
    {
        $district = ShippingDistrictModel::find($id);
        if ($district != null) {
            $district->status = 1;
            $district->update();
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping status Published successful');
    }

    public function unpublished_shipping($id)
    {
        $district = ShippingDistrictModel::find($id);
        if ($district != null) {
            $district->status = 0;
            $district->update();
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Shipping status Unpublished successful');
    }

//   *************** payment method**************************
    public function publish_payment($id)
    {
        $district = PurchaseSettingsPaymentMethod::find($id);
        if ($district != null) {
            $district->status = 1;
            $district->update();
        } else {
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'payment was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment status Published successful');
    }

    public function unpublished_payment($id)
    {
        $district = PurchaseSettingsPaymentMethod::find($id);
        if ($district!=null){
            $district->status = 0;
            $district->update();
        }else{
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'payment was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment status Unpublished successful');
    }

    public function delete_payment($id)
    {
        $district = PurchaseSettingsPaymentMethod::find($id);
        if ($district!=null){
            $district->delete();
        }else{
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment already delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment delete successful');
    }

    public function edit_payment($id)
    {
        $payment = PurchaseSettingsPaymentMethod::find($id);
        if ($payment!=null){
            return view('back_end.purchase_settings.edit_payment_settings', ['payment' => $payment]);
        }else{
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment was delete');
        }
    }

    private function payment_validation($request)
    {
        $this->validate($request, [
            'method_name' => 'required|max:255',
            'text' => 'required|max:255',
            'status' => 'required|integer|min:0|max:1',
        ]);

    }

    private function insert_payment_info($request, $work)
    {
        if ($work == 'i') {
            $payment = new PurchaseSettingsPaymentMethod();
        } else {
            $payment = PurchaseSettingsPaymentMethod::find($request->id);
        }
        $payment->method_name = $request->method_name;
        $payment->text = $request->text;
        $payment->status = $request->status;
        return $payment;
    }

    public function payment_edit_save(request $request)
    {
        $this->payment_validation($request);
        $payment = PurchaseSettingsPaymentMethod::find($request->id);
        if ($payment!=null){
            $payment = $this->insert_payment_info($request, 'u');
            $payment->update();
        }else{
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'payment was delete');
        }
        return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'Payment update successful');
    }


    public function texUpdate(request $request)
    {
        $tax = TaxModel::find($request->id);
        if ($tax!=null){
            $tax->tax_amount = $request->tax;
            $tax->update();
        }else{
            return redirect('/dashboard/utilities/purchase-settings')->with('massage', 'tax was delete');
        }
        return back()->with('massage', 'Tax update successful');
    }

}
