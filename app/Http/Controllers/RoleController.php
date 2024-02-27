<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    
    public function List()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('templates.pages.product_role_list', compact('roles'));
    }

    public function add()
    {
        return view('templates.pages.forms.product_role_form');
    }

    public function delete($id)
    {
        $role = Role::where('id', $id)->delete();
        if ($role) {
            return redirect()->back()->with('success', 'Role deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        if (!$role) {
            return redirect()->back()->with('error', 'Role not exist!!!');
        }
        return view('templates.pages.forms.product_role_form', compact('role'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $role = Role::where('id', $req->id)->first();

        if (!$role) {
            return redirect()->back()->with('error', 'No role found!');
        }

        $role->name = $req->name;

        if ($role->save()) {
            return redirect()->route('role.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('role.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $role = Role::create($InsertData);

        if ($role) {
            return redirect()->route('role.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('role.list')->with('error', 'Something went wrong');
        }
    }
}
