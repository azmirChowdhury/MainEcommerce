<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Co_UserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        return view('back_end.user.manage_admin');
    }
    public function UserDelete(request $request){
        $this->validate($request,[
           'user_id'=>'required|integer',
           'password'=>'required',
        ]);
        $user_co=User::find($request->user_id);
        $permission=Co_UserModel::where('user_id',$user_co->id)->first();
     if (password_verify($request->password,$user_co->password)){
         if ($permission!=null){
             $permission->delete();
         }
         $user_co->tokens->each->delete();
         $user_co->delete();
         return redirect()->back()->with('massage','Admin delete successful');
     }else{
         return redirect('admin/main-admin-manage-admin')->with('massage','Admin delete failed');
     }
    }
    public function publish_admin($id){
        $user=User::find($id);
        $user->status=1;
        $user->update();
        return redirect('admin/main-admin-manage-admin')->with('massage','Admin '.$user->name.' status publish successful');
    }
    public function unpublished_admin($id){
        $user=User::find($id);
        $user->status=0;
        $user->update();
        return redirect('admin/main-admin-manage-admin')->with('massage','Admin '.$user->name.' status Unpublished successful');
    }
}
