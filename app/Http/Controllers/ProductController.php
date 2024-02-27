<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductFeet;
class ProductController extends Controller
{
    public function List()
    {
        $products = Product::orderBy('feet','ASC')->get();
        return view('templates.pages.product_list', compact('products'));
    }

    public function add()
    {
        $types = ProductType::all();
        $feets = ProductFeet::all();
        return view('templates.pages.forms.product_form',compact('types','feets'));
    }

    public function delete($id)
    {
        $feet = Product::where('id', $id)->delete();
        if ($feet) {
            return redirect()->back()->with('success', 'Feet deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $feet = Product::where('id', $id)->first();
        if (!$feet) {
            return redirect()->back()->with('error', 'Feet not exist!!!');
        }
        return view('templates.pages.forms.product_form', compact('feet'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $feet = Product::where('id', $req->id)->first();

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
        return $req->all();

        $InsertData['name'] = $req->name;
        $InsertData['feet'] = $req->feet_id;
        $InsertData['price'] = $req->price;
        // $InsertData['thumbnail'] = $req->age;
        // $InsertData['images'] = $req->phone;
        $InsertData['body_color'] = $req->body_color;
        $InsertData['pancha_saree_color'] = $req->pancha_saree_color;
        $InsertData['type_id'] = $req->type_id;
        $InsertData['created_by'] = auth()->user()->id;
        $InsertData['model'] = $req->age;
        $InsertData['status'] = $req->status ? 1 : 0;
        $InsertData['count'] = $req->count;

        if ($req->hasFile('photo')) {
            if ($uploadStatus = $this->uploadFile("uploads/users/profiles", $req->file('photo'), time())) {
                $InsertData['photo'] = $uploadStatus;
            } else {
                throw new Exception('Failed to upload profile picture', 500);
            }
        }


        $users = User::create($InsertData);

        if ($feet) {
            return redirect()->route('feet.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('feet.list')->with('error', 'Something went wrong');
        }
    }
}
