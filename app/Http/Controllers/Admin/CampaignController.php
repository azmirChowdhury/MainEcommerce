<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CampaignModel;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(){
        $campaign=CampaignModel::all();
        return view('back_end.campaign.manage_campaign',['campaigns'=>$campaign]);
    }

    public function add_campaign(){
        $data['categories']=SubcategoryModel::all();
        $data['products']=ProductModel::all();
        return view('back_end.campaign.add_campaign',['data'=>$data]);
    }

    private function validation($request){
        $this->validate($request,[
           'campaign_name'=>'required',
           'campaign_description'=>'required',
           'discount_type'=>'required',
           'discount_amount'=>'required|integer',
           'start_date'=>'required',
           'end_date'=>'required',
           'status'=>'required',
        ]);
    }
    private function valid_category_product($request){
        $this->validate($request,[
           'category'=>'required',
           'product'=>'required',
        ]);
    }

    private function campaign_info_insert($request,$work){
        if ($work=='i'){
            $campaign=new CampaignModel();
        }else{
            $campaign=CampaignModel::find($request->id);
        }
        $campaign->campaign_name=$request->campaign_name;
        $campaign->campaign_description=$request->campaign_description;
        $campaign->discount_type=$request->discount_type;
        $campaign->discount_amount=$request->discount_amount;
        $campaign->campaign_start=$request->start_date;
        $campaign->campaign_end=$request->end_date;
        $campaign->category_id=json_encode($request->category);
        $campaign->product_id=json_encode($request->product);
        $campaign->status=$request->status;
        return $campaign;
    }

    public function save_campaign(request $request){

        if (!empty($request->category)||!empty($request->product)){
            $this->validation($request);
            $campaign=$this->campaign_info_insert($request,'i');
            $campaign->save();
            return redirect('dashboard/campaign/add-campaign')->with('massage','New campaign '.$request->campaign_name.' save successful');
        }else{
            $this->valid_category_product($request);
       }
    }


    public function edit_campaign($id){
        $data['categories']=SubcategoryModel::all();
        $data['products']=ProductModel::all();
        $data['campaign']=CampaignModel::find($id);
        if ($data['campaign']!=null){
            return view('back_end.campaign.edit_campaign',['data'=>$data]);
        }else{
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign  was deleted');
        }
    }

    public function edit_save_campaign(request $request){
        $this->validate($request,[
            'id'=>'required|integer'
        ]);
        $campaign=CampaignModel::find($request->id);
        if ($campaign!=null){
        if (!empty($request->category)||!empty($request->product)){
            $this->validation($request);
            $campaign=$this->campaign_info_insert($request,'u');
            $campaign->update();
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign '.$request->campaign_name.' save successful');
        }else{
            $this->valid_category_product($request);
        }
        }else{
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign  was deleted');
        }
    }

    public function delete_campaign($id){
        $campaign=CampaignModel::find($id);
        if ($campaign!=null) {
            $campaign->delete();
        }else{
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign  already delete');
        }
        return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign delete  successful');
    }

    public function published_campaign($id){
        $campaign=CampaignModel::find($id);
        if ($campaign!=null) {
            $campaign->status = 1;
            $campaign->update();
        }else{
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign  was deleted');
        }
        return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign status Published  successful');
    }
    public function unpublished_campaign($id){
        $campaign=CampaignModel::find($id);
        if ($campaign!=null) {
            $campaign->status = 0;
            $campaign->update();
        }else{
            return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign was deleted');
        }
        return redirect('dashboard/campaign/manage-campaign')->with('massage','Campaign status Unpublished  successful');
    }

}
