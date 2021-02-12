<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupon=CouponModel::all();
        return view('back_end.coupon.manage_coupon',['coupons'=>$coupon]);
    }

    public function add_coupon(){
        $data['categories']=SubcategoryModel::all();
        $data['products']=ProductModel::all();
        return view('back_end.coupon.add_coupon',['data'=>$data]);
    }

    private function validation($request){
        $this->validate($request,[
            'coupon_code'=>'required',
            'coupon_description'=>'required',
            'discount_type'=>'required|integer',
            'discount_amount'=>'required|integer',
            'expire_date'=>'required',
            'minimum_spend'=>'required|integer',
            'maximum_spend'=>'required|integer',
            'per_coupon'=>'required|integer',
            'per_user'=>'required|integer',
            'status'=>'required|integer',
        ]);
    }
    private function valid_category_product($request){
        $this->validate($request,[
            'category'=>'required|integer',
            'product'=>'required|integer',
        ]);
    }

    private function coupon_info_insert($request,$work){
        if ($work=='i'){
            $coupon=new CouponModel();
        }else{
            $coupon=CouponModel::find($request->id);
        }
        $coupon->coupon_code=$request->coupon_code;
        $coupon->coupon_description=$request->coupon_description;
        $coupon->discount_type=$request->discount_type;
        $coupon->discount_amount=$request->discount_amount;
        $coupon->expire_date=$request->expire_date;
        $coupon->minimum_spend=$request->minimum_spend;
        $coupon->maximum_spend=$request->maximum_spend;
        $coupon->limit_per_coupon=$request->per_coupon;
        $coupon->limit_per_user=$request->per_user;
        $coupon->category_id=json_encode($request->category);
        $coupon->product_id=json_encode($request->product);
        $coupon->status=$request->status;
        return $coupon;
    }

    public function save_coupon(request $request){

        if (!empty($request->category)||!empty($request->product)){
            $this->validation($request);
            $coupon=$this->coupon_info_insert($request,'i');
            $coupon->save();
            return redirect('dashboard/coupon/add-coupon')->with('massage','New coupon '.$request->coupon_code.' save successful');
        }else{
            $this->valid_category_product($request);
        }
    }


    public function edit_coupon($id){
        $data['categories']=SubcategoryModel::all();
        $data['products']=ProductModel::all();
        $data['coupon']=CouponModel::find($id);
        return view('back_end.coupon.edit_coupon',['data'=>$data]);
    }

    public function edit_save_coupon(request $request){
        $this->validate($request,[
            'id'=>'required|integer'
        ]);
        if (!empty($request->category)||!empty($request->product)){
            $this->validation($request);
            $campaign=$this->coupon_info_insert($request,'u');
            $campaign->update();
            return redirect('dashboard/coupon/manage-coupon')->with('massage','Coupon '.$request->coupon_code.' save successful');
        }else{
            $this->valid_category_product($request);
        }
    }

    public function delete_coupon($id){
        $campaign=CouponModel::find($id);
        $campaign->delete();
        return redirect('dashboard/coupon/manage-coupon')->with('massage','Coupon delete  successful');
    }

    public function published_coupon($id){
        $campaign=CouponModel::find($id);
        $campaign->status=1;
        $campaign->update();
        return redirect('dashboard/coupon/manage-coupon')->with('massage','Campaign status Published  successful');
    }
    public function unpublished_coupon($id){
        $campaign=CouponModel::find($id);
        $campaign->status=0;
        $campaign->update();
        return redirect('dashboard/coupon/manage-coupon')->with('massage','Campaign status Unpublished  successful');
    }

}
