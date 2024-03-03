<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function landingPage()
    {
        $pageConfigs = ['myLayout' => 'front'];
        $productTypes = ProductType::all();
        $testimonials = Testimonial::orderBy('id','DESC')->get();
        return view('templates.front.landing-page',compact('pageConfigs','productTypes','testimonials'));
    }
}
