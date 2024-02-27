<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FileUploadTrait;

    public function List()
    {
        $users = User::where('id', '!=', 1)->orderBy('id', 'DESC')->get();
        return view('templates.pages.admins_list', compact('users'));
    }

    public function add()
    {
        $roles = Role::all();
        return view('templates.pages.forms.admin_form', compact('roles'));
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'User deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not exist!!!');
        }
        return view('templates.pages.forms.admin_form', compact('user', 'roles'));
    }

    public function editSubmit(Request $req)
    {
        $ifExists = User::where('id', '!=', $req->id)->where('email', $req->email)->first();

        if ($ifExists) {
            return redirect()->back()->with('error', 'Email already exist!!!');
        }

        $user = User::findOrFail($req->id);
        $user->email = $req->email;
        $user->name = $req->username;

        $user['email'] = $req->email;
        $user['name'] = $req->name;
        $user['age'] = $req->age;
        $user['phone'] = $req->phone;
        $user['is_active'] = $req->status ? 1 : 0;
        $user['role_id'] = $req->role_id;

        if ($req->hasFile('photo')) {
            if ($uploadStatus = $this->uploadFile("uploads/users/profiles", $req->file('photo'), time())) {
                $user['photo'] = $uploadStatus;
            } else {
                throw new Exception('Failed to upload profile picture', 500);
            }
        }
        if ($req->password) {
            $user->password = Hash::make($req->password);
        }

        if ($user->save()) {
            return redirect()->route('user.profile.view', ['id' => $user->id])->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('user.profile.view', ['id' => $user->id])->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $ifExist = User::where('email', $req->email)->first();
        if ($ifExist) {
            return redirect()->back()->with('error', 'Email already exist!!!');
        }

        $InsertData['email'] = $req->email;
        $InsertData['name'] = $req->name;
        $InsertData['password'] = Hash::make($req->password);
        $InsertData['age'] = $req->age;
        $InsertData['phone'] = $req->phone;
        $InsertData['is_active'] = $req->status ? 1 : 0;
        $InsertData['role_id'] = $req->role_id;

        if ($req->hasFile('photo')) {
            if ($uploadStatus = $this->uploadFile("uploads/users/profiles", $req->file('photo'), time())) {
                $InsertData['photo'] = $uploadStatus;
            } else {
                throw new Exception('Failed to upload profile picture', 500);
            }
        }


        $users = User::create($InsertData);

        if ($users) {
            return redirect()->route('users.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('users.list')->with('error', 'Something went wrong');
        }
    }

    public function viewUserProfile($id)
    {
        $user = User::findOrFail($id);
        return view('templates.pages.user_profile.profile', compact('user'));
    }
}
