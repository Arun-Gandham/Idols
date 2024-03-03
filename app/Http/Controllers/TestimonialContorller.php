<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialContorller extends Controller
{
    
    
    public function List()
    {
        $testimonials = Testimonial::orderBy('id','DESC')->get();
        return view('templates.pages.testimonials_list', compact('testimonials'));
    }

    public function add()
    {
        return view('templates.pages.forms.testimonial_form');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::where('id', $id)->delete();
        if ($testimonial) {
            return redirect()->back()->with('success', 'Testimonial deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        if (!$testimonial) {
            return redirect()->back()->with('error', 'Testimonial not exist!!!');
        }
        return view('templates.pages.forms.testimonial_form', compact('testimonial'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $testimonial = Testimonial::where('id', $req->id)->first();

        if (!$testimonial) {
            return redirect()->back()->with('error', 'No testimonial found!');
        }

        $testimonial->name = $req->name;
        $testimonial->comment = $req->comment;
        $testimonial->star = $req->star;

        if ($testimonial->save()) {
            return redirect()->route('testimonials.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('testimonials.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $InsertData['comment'] = $req->comment;
        $InsertData['star'] = $req->star;
        $testimonial = Testimonial::create($InsertData);

        if ($testimonial) {
            return redirect()->route('testimonials.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('testimonials.list')->with('error', 'Something went wrong');
        }
    }
}
