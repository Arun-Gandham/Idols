<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function list()
    {
        $pageSettings['title'] = "Product List";
        $pageSettings['type'] = "Product";
        $products = Order::orderBy('id', 'ASC')->get();
        return view('templates.pages.product_list', compact('products', 'pageSettings'));
    }

    public function add()
    {
        $statuses = OrderStatus::all();
        $products = Product::all();

        $pageSettings['title'] = "Add Order";
        return view('templates.pages.forms.order_form', compact('statuses', 'products', 'pageSettings'));
    }

    public function datatblesList(Request $request)
    {
        $data = Order::orderBy('id', 'desc')->get(); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (User $user) {
                return '<div class="d-flex">
                    <a href="' . route('admin.delete', $user->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('admin.edit', $user->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
