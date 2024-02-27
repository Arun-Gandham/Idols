<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function List()
    {
        return view('templates.pages.admins_list');
    }

    public function add()
    {
        return view('templates.pages.forms.admin_form');
    }

    public function delete($id)
    {
        $user = User::where('id',$id)->delete();
        if($user)
        {
            return redirect()->back()->with('success','User deleted succesfully');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user)
        {
            return redirect()->back()->with('error','User not exist!!!');
        }
        return view('templates.pages.forms.admin_form',compact('user'));
    }

    public function editSubmit(Request $req)
    {
        $ifExists = User::where('id','!=',$req->id)->where('email',$req->email)->first();

        if($ifExists)
        {
            return redirect()->back()->with('error','Email already exist!!!');
        }

        $user = User::findOrFail($req->id);
        $user->email = $req->email;
        $user->name = $req->username;
        if($req->password)
        {
            $user->password = $req->password;
        }
        
        if($user->save())
        {
            return redirect()->route('admin.list')->with('success','Succesfully updated');
        }
        else
        {
            return redirect()->route('admin.list')->with('error','Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $ifExist = User::where('email',$req->email)->first();

        if($ifExist)
        {
            return redirect()->back()->with('error','Email already exist!!!');
        }

        $users = User::create(
            [
            'name' => $req->name, 
            'email' => $req->email, 
            'password' => $req->password,
            'photo' => $req->name, 
            'age' => $req->age, 
            'phone' => $req->phone,
            'is_active' => isset($req->role_id) ? 1 : 0, 
            'role_id' => $req->role_id,
            ]
        );

        if($users)
        {
            return redirect()->route('admin.list')->with('success','Succesfully created');
        }
        else
        {
            return redirect()->route('admin.list')->with('error','Something went wrong');
        }
    }
}
