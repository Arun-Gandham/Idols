<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderTimeline;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

class OrderController extends Controller
{
    public function list()
    {
        $pageSettings['title'] = "Order List";
        $products = Order::orderBy('id', 'ASC')->get();
        return view('templates.pages.order_list', compact('products', 'pageSettings'));
    }

    public function add()
    {
        $statuses = OrderStatus::all();
        $products = Product::all();
        $pageSettings['title'] = "Add Order";
        return view('templates.pages.forms.order_form', compact('statuses', 'products', 'pageSettings'));
    }

    public function edit($id)
    {

        $order = Order::findOrFail($id);
        if (!$order) {
            return redirect()->back()->with('error', 'No Order found!');
        }
        $statuses = OrderStatus::all();
        $products = Product::all();
        $pageSettings['title'] = "Edit Order";
        return view('templates.pages.forms.order_form', compact('statuses', 'products', 'pageSettings', 'order'));
    }

    public function datatblesList()
    {
        $data = Order::orderBy('id', 'DESC')->get(); // Replace with your model and desired columns

        return DataTables::of($data)
            ->addColumn('actions', function (Order $order) {
                return '<a href="' . route('order.edit', $order->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i> Edit</a>';
            })
            ->addColumn('product_name', function (Order $order) {
                if ($order->product) {
                    return $order->product->name; // Access the product name assuming 'name' is the column name
                } else {
                    return ''; // Return an empty string or any default value if product is null
                }
            })
            ->addColumn('date', function (Order $order) {
                $dateTime = new DateTime($order->created_at);
                $today = new DateTime('today');
                $yesterday = new DateTime('yesterday');

                if ($dateTime->format('Y-m-d') === $today->format('Y-m-d')) {
                    return 'Today ' . $dateTime->format('g:i A');
                } elseif ($dateTime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
                    return 'Yesterday ' . $dateTime->format('g:i A');
                } else {
                    return $dateTime->format('d F Y g:i A'); // Format as '23 April 2023'
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function editSubmit(Request $req)
    {
        $order = Order::findOrFail($req->id);
        $order->name = $req->name;
        $order->phone1 = $req->phone1;
        $order->phone2 = $req->phone2;
        $order->price = $req->price;
        $order->crane_price = $req->crane_price;
        $order->cover_price = $req->cover_price;
        $order->address = $req->address;
        $order->note = $req->note;
        $order->product_id = $req->product_id;
        if ($order->save()) {
            return redirect()->route('order.list')->with('success', 'Successfully order updated');
        }
        return redirect()->back()->with('error', 'Failed to updated order.');
    }

    public function addSubmit(Request $req)
    {
        $InsertData['model'] = 123;
        $InsertData['name'] = $req->name;
        $InsertData['phone1'] = $req->phone1;
        $InsertData['phone2'] = $req->phone2;
        $InsertData['status_id'] = $req->status;
        $InsertData['price'] = $req->price;
        $InsertData['crane_price'] = $req->crane_price;
        $InsertData['cover_price'] = $req->cover_price;
        $InsertData['address'] = $req->address;
        $InsertData['note'] = $req->note;
        $InsertData['product_id'] = $req->product_id;
        $InsertData['created_by'] = auth()->user()->id;
        $order = Order::create($InsertData);
        if ($order) {
            $order->order_id = "#" . str_pad($order->id, 5, '0', STR_PAD_LEFT);
            $order->save();
            return redirect()->route('order.list')->with('success', 'Successfully order created');
        }
        return redirect()->back()->with('error', 'Failed to create order.');
    }

    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);
        $statuses = OrderStatus::all();
        $pageSettings['title'] = "View Order";
        return view('templates.pages.order_view.details_view', compact('pageSettings', 'order', 'statuses'));
    }
}
