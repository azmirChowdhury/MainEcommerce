<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIconModel;
use Illuminate\Http\Request;

class Social_iconControlle extends Controller
{
    public function index()
    {
        $social = SocialIconModel::all();
        return view('back_end.social_share.manage_icon', ['socials' => $social]);
    }

    public function add_link()
    {
        return view('back_end.social_share.add_icon');
    }

    private function validation($request)
    {
        $this->validate($request, [
            'platform_name' => 'required|max:250',
            'url' => 'required',
            'icon_class' => 'required|max:30',
            'status' => 'required|integer|min:0|max:1',
        ]);
        if (!empty($request->id)==true){
            $this->validate($request, [
                'id' =>'required|integer',
            ]);
        }
    }

    private function information_insert($request, $work)
    {
        if ($work == 'i') {
            $social = new SocialIconModel();
        } else {
            $social = SocialIconModel::find($request->id);
        }
        $social->platform_name = $request->platform_name;
        $social->url = $request->url;
        $social->icon_class = $request->icon_class;
        $social->status = $request->status;
        return $social;
    }

    public function save_link(request $request)
    {
        $this->validation($request);
        $social = $this->information_insert($request, 'i');
        $social->save();
        return redirect('/dashboard/utilities/social-share-new-add')->with('massage', 'New Link ' . $request->platform_name . ' save successful');
    }

    public function edit_icon($id)
    {
        $icon = SocialIconModel::find($id);
        return view('back_end.social_share.edit_icon', ['social' => $icon]);
    }

    public function save_edit_link(request $request)
    {
        $this->validation($request);
        $social = $this->information_insert($request, 'u');
        $social->update();
        return redirect('/dashboard/utilities/social-share-manage')->with('massage', 'New Link ' . $request->platform_name . ' Update successful');
    }

    public function icon_publish($id)
    {
        $social=SocialIconModel::find($id);
        $social->status=1;
        $social->update();
        return redirect('/dashboard/utilities/social-share-manage')->with('massage', 'Link  status publish successful');
    }
    public function icon_unpublished($id)
    {
        $social=SocialIconModel::find($id);
        $social->status=0;
        $social->update();
        return redirect('/dashboard/utilities/social-share-manage')->with('massage', 'Link  status unpublished successful');
    }
    public function icon_delete($id)
    {
        $social=SocialIconModel::find($id);
        $social->delete();
        return redirect('/dashboard/utilities/social-share-manage')->with('massage', 'Link  delete successful');
    }


}
