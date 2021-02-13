<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Co_UserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {

        return view('back_end.user.manage_admin');
    }

    public function UserDelete(request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'password' => 'required',
        ]);
        $user_co = User::find($request->user_id);
        $permission = Co_UserModel::where('user_id', $user_co->id)->first();
        if (password_verify($request->password, $user_co->password)) {
            if ($permission != null) {
                $permission->delete();
            }
            $user_co->tokens->each->delete();
            $user_co->delete();
            return redirect()->back()->with('massage', 'Admin delete successful');
        } else {
            return redirect('admin/main-admin-manage-admin')->with('massage', 'Admin delete failed');
        }
    }

    public function publish_admin($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->update();
        return redirect('admin/main-admin-manage-admin')->with('massage', 'Admin ' . $user->name . ' status publish successful');
    }

    public function unpublished_admin($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->update();
        return redirect('admin/main-admin-manage-admin')->with('massage', 'Admin ' . $user->name . ' status Unpublished successful');
    }

    public function edit_co_user($id)
    {
        $user = User::find($id);
        $role = Co_UserModel::where('user_id', $user->id)->first();
        $permission = json_decode($role->permission);
        return view('back_end.user.edit_co_user', ['user' => $user, 'role' => $permission]);
    }

    private function validation($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required|integer|min:0|max:1',
            'id' => 'required|integer',
        ]);
        if ($request->role == 2) {
            $this->validate($request, [
                'permission' => 'required|array',
            ]);
        }
    }

    private function insert_user_info($request)
    {
        $user = User::find($request->id);
        $role = Co_UserModel::where('user_id', $user->id)->first();
        $role->permission = json_encode($request->role == 1 ? [0] : $request->permission);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->update();
        $role->update();

    }

    public function edit_user_save(request $request)
    {
        $this->validation($request);
        $this->insert_user_info($request);
        return redirect('admin/main-admin-manage-admin')->with('massage', 'User ' . $request->name . ' Update successful');
    }

    public function change_password($id)
    {
        $user = User::find($id);
        return view('back_end.user.password_change', ['user' => $user]);
    }

    private function password_validation($request)
    {


    }

    public function change_password_save(request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'current_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required',
        ]);
        $password = User::find($request->id);
        if (password_verify($request->current_password, $password->password)) {
            if ($request->password == $request->password_confirmation) {
                $password->password=Hash::make($request->password);
                $password->update();
                return redirect('admin/main-admin-manage-admin')->with('massage', 'Password has change successful');
            } else {
                $err = 'New password and confirm password not match';
                return redirect()->back()->with('massage', $err);
            }
        } else {
            $err = 'Old password not match';
            return redirect()->back()->with('massage', $err);
        }
    }
}
