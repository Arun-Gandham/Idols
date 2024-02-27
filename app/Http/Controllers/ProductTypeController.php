<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function List()
    {
        $types = ProductType::orderBy('id','DESC')->get();
        return view('templates.pages.product_type_list', compact('types'));
    }

    public function add()
    {
        return view('templates.pages.forms.product_type_form');
    }

    public function delete($id)
    {
        $type = ProductType::where('id', $id)->delete();
        if ($type) {
            return redirect()->back()->with('success', 'Product type deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $type = ProductType::where('id', $id)->first();
        if (!$type) {
            return redirect()->back()->with('error', 'Type not exist!!!');
        }
        return view('templates.pages.forms.product_type_form', compact('type'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $type = ProductType::where('id', $req->id)->first();

        if (!$type) {
            return redirect()->back()->with('error', 'No type found!');
        }

        $type->name = $req->name;

        if ($type->save()) {
            return redirect()->route('type.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('type.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $type = ProductType::create($InsertData);

        if ($type) {
            return redirect()->route('type.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('type.list')->with('error', 'Something went wrong');
        }
    }
}
