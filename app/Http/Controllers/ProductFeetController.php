<?php

namespace App\Http\Controllers;

use App\Models\ProductFeet;
use Illuminate\Http\Request;

class ProductFeetController extends Controller
{

    public function List()
    {
        $feets = ProductFeet::orderBy('feet','ASC')->get();
        return view('templates.pages.product_feet_list', compact('feets'));
    }

    public function add()
    {
        return view('templates.pages.forms.product_feet_form');
    }

    public function delete($id)
    {
        $feet = ProductFeet::where('id', $id)->delete();
        if ($feet) {
            return redirect()->back()->with('success', 'Feet deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $feet = ProductFeet::where('id', $id)->first();
        if (!$feet) {
            return redirect()->back()->with('error', 'Feet not exist!!!');
        }
        return view('templates.pages.forms.product_feet_form', compact('feet'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $feet = ProductFeet::where('id', $req->id)->first();

        if (!$feet) {
            return redirect()->back()->with('error', 'No Feet Found!');
        }

        $feet->feet = $req->feet;

        if ($feet->save()) {
            return redirect()->route('feet.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('feet.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['feet'] = $req->feet;
        $feet = ProductFeet::create($InsertData);

        if ($feet) {
            return redirect()->route('feet.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('feet.list')->with('error', 'Something went wrong');
        }
    }
}
