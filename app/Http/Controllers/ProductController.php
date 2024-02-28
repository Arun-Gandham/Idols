<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFeet;
use App\Models\ProductType;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    use FileUploadTrait;

    public function list()
    {
        $pageSettings['title'] = "Product List";
        $pageSettings['type'] = "Product";
        $products = Product::where('is_deleted',0)->orderBy('id', 'ASC')->get();
        return view('templates.pages.product_list', compact('products','pageSettings'));
    }

    public function deletedList()
    {
        $pageSettings['title'] = "Deleted Product List";
        $pageSettings['type'] = "Product";
        $products = Product::where('is_deleted',1)->orderBy('id', 'ASC')->get();
        return view('templates.pages.product_deleted_list', compact('products','pageSettings'));
    }

    public function add()
    {

        $pageSettings['title'] = "Add Product";
        $types = ProductType::all();
        $feets = ProductFeet::all();
        return view('templates.pages.forms.product_form', compact('types', 'feets','pageSettings'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $product->is_deleted = 1;
        if ($product->save()) {
            return redirect()->route('product.list')->with('success', 'Product deleted successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $pageSettings['title'] = "Edit Product";
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        $types = ProductType::all();
        $feets = ProductFeet::all();
        return view('templates.pages.forms.product_form', compact('product', 'types', 'feets','pageSettings'));
    }

    public function editSubmit(Request $req)
    {
        $product = Product::where('id', $req->id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'No Product Found!');
        }

        $product->name = $req->name;
        $product->feet_id = $req->feet_id;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->body_color = $req->body_color;
        $product->pancha_saree_color = $req->pancha_saree_color;
        $product->type_id = $req->type_id;
        $product->created_by = auth()->user()->id;
        $product->model = 2023;
        $product->status = $req->status ? 1 : 0;
        $product->stock = $req->stock;

        if ($product->save()) {
            if ($req->hasFile('thumbnail')) {
                unlink($product->thumbnail);
                if ($uploadStatus = $this->uploadFile("uploads/products/{$product->id}", $req->file('thumbnail'), time())) {
                    $product->thumbnail = $uploadStatus;
                    $product->save();
                } else {
                    throw new Exception('Failed to upload profile picture', 500);
                }
            }
            if ($req->hasFile('images')) {
                $paths = [];
                $count = 0;
                if (count(unserialize($product->images))) {
                    foreach (unserialize($product->images) as $file) {
                        unlink($file);
                    }
                }
                foreach ($req->file('images') as $file) {
                    $filename = time() . '_' . $count . '_' . $file->getClientOriginalName();
                    $file->move(public_path("uploads/products/{$product->id}"), $filename);
                    $paths[] = "uploads/{$product->id}/products/profiles/{$filename}";
                    $count++;
                }
                $product->images = serialize($paths);
                $product->save();
            }
            return redirect()->route('product.details.view',['id' => $product->id])->with('success', 'Succesfully product updated');
        }
        return redirect()->route('product.details.view',['id' => $product->id])->with('error', 'Something went wrong');
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $InsertData['feet_id'] = $req->feet_id;
        $InsertData['description'] = $req->description;
        $InsertData['price'] = $req->price;
        $InsertData['body_color'] = $req->body_color;
        $InsertData['pancha_saree_color'] = $req->pancha_saree_color;
        $InsertData['type_id'] = $req->type_id;
        $InsertData['created_by'] = auth()->user()->id;
        $InsertData['model'] = 2023;
        $InsertData['status'] = $req->status ? 1 : 0;
        $InsertData['stock'] = $req->stock;
        $product = Product::create($InsertData);
        if ($product) {
            if ($req->hasFile('thumbnail')) {
                if ($uploadStatus = $this->uploadFile("uploads/products/{$product->id}", $req->file('thumbnail'), time())) {
                    $product->thumbnail = $uploadStatus;
                    $product->save();
                } else {
                    throw new Exception('Failed to upload profile picture', 500);
                }
            }
            if ($req->hasFile('images')) {
                $paths = [];
                $count = 0;
                foreach ($req->file('images') as $file) {
                    $filename = time() . '_' . $count . '_' . $file->getClientOriginalName();
                    $file->move(public_path("uploads/products/{$product->id}"), $filename);
                    $paths[] = "uploads/{$product->id}/products/profiles/{$filename}";
                    $count++;
                }
                $product->images = serialize($paths);
                $product->save();
            }
        }
        return redirect()->route('product.list')->with('success', 'Succesfully product created');
    }

    public function restore($id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        $product->is_deleted = 0;
        if($product->save())
        {
            return redirect()->route('product.list')->with('success','Product restored successfully.');
        }
        return redirect()->back()->with('error','Something went wrong');
    }

    public function detailsView($id)
    {
        $pageSettings['title'] = "Product Details";
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        return view('templates.pages.product_view.details_view', compact('product','pageSettings'));
    }

    public function teamsView($id)
    {
        $pageSettings['title'] = "Product Details";
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        return view('templates.pages.product_view.teams_view', compact('product','pageSettings'));
    }

    public function stockView($id)
    {
        $pageSettings['title'] = "Product Details";
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        return view('templates.pages.product_view.stock_view', compact('product','pageSettings'));
    }

    public function otherView($id)
    {
        $pageSettings['title'] = "Product Details";
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not exist!!!');
        }
        return view('templates.pages.product_view.other_view', compact('product','pageSettings'));
    }
}
