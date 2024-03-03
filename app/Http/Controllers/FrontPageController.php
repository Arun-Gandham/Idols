<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function landingPage()
    {
        $pageConfigs = ['myLayout' => 'front'];
        $productTypes = ProductType::all();
        return view('templates.front.landing-page',compact('pageConfigs','productTypes'));
    }
}
