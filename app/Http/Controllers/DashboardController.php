<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Home()
    {
        $settings = Setting::first();
        $revenueGenerated = 
        $products = Product::where('model',$settings->model)->get();
        return view('templates.pages.dashboard',compact('products'));
    }

    public function navbarSearch()
    {
        return json_encode(["users" => [
              [
                "name"=> "Dashboard Analytics",
                "icon"=>"ti-smart-home",
                "url"=> "/"
              ]
        ]]);
    }
    
}