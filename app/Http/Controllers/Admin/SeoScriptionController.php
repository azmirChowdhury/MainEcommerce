<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MetaScriptModel;
use Illuminate\Http\Request;

class SeoScriptionController extends Controller
{
    public function index(){
        $tag=MetaScriptModel::all();
        return view('back_end.seo_meta_scripting.manage_script',['tags'=>$tag]);
    }


    public function add_meta_script(){

        return view('back_end.seo_meta_scripting.add_script_meta');
    }
    private function validation($request){
        $this->validate($request,[
            'tag'=>'required',
            'position'=>'required|integer',
            'status'=>'required|integer',
        ]);
        if (!empty($request->id)==true){
            $this->validate($request,[
                'id'=>'required|integer',
            ]);
        }

    }
    private function information_insert($request,$work){
        if ($work=='i'){
            $tag=new MetaScriptModel();
        }else{
            $tag=MetaScriptModel::find($request->id);
        }
        $tag->tag=$request->tag;
        $tag->position=$request->position;
        $tag->status=$request->status;
        return $tag;
    }

    public function meta_script_save(Request $request){
        $this->validation($request);
        $tag=$this->information_insert($request,'i');
        $tag->save();
        return redirect('/dashboard/utilities/seo-script-add')->with('massage','New meta/script save successful');
    }
    public function edit_meta($id){
        $tag=MetaScriptModel::find($id);
        if ($tag!=null){
            return view('back_end.seo_meta_scripting.edit_script_meta',['tag'=>$tag]);
        }else{
            return redirect('/dashboard/utilities/seo-script-manage')->with('massage','New meta/script was deleted');
        }
    }
    public function edit_update(request $request){
        $this->validation($request);
        $tag=MetaScriptModel::find($request->id);
        if ($tag!=null){
            $tag=$this->information_insert($request,'u');
            $tag->update();
        }else{
            return redirect('/dashboard/utilities/seo-script-manage')->with('massage','New meta/script was deleted');
        }
        return redirect('/dashboard/utilities/seo-script-manage')->with('massage','New meta/script update successful');
    }

    public function tag_publish($id){
        $tag=MetaScriptModel::find($id);
        if ($tag!=null){
            $tag->status=1;
            $tag->update();
        }else{
            return redirect('/dashboard/utilities/seo-script-manage')->with('massage','meta/script was deleted');
        }
        return redirect('/dashboard/utilities/seo-script-manage')->with('massage','meta/script status Publish successful');
    }

    public function tag_unpublished($id){
        $tag=MetaScriptModel::find($id);
        if ($tag!=null){
            $tag->status=0;
            $tag->update();
        }else{
            return redirect('/dashboard/utilities/seo-script-manage')->with('massage','meta/script was deleted');
        }
        return redirect('/dashboard/utilities/seo-script-manage')->with('massage','meta/script status Unpublished successful');
    }

    public function tag_delete($id){
        $tag=MetaScriptModel::find($id);
        if ($tag!=null){
            $tag->delete();
        }else{
            return redirect('/dashboard/utilities/seo-script-manage')->with('massage',' meta/script already deleted');
        }
        return redirect('/dashboard/utilities/seo-script-manage')->with('massage',' meta/script Delete successful');
    }

}
