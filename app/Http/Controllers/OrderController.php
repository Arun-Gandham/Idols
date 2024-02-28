<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function list()
    {
        $pageSettings['title'] = "Product List";
        $pageSettings['type'] = "Product";
        $products = Order::orderBy('id', 'ASC')->get();
        return view('templates.pages.product_list', compact('products','pageSettings'));
    }
}
