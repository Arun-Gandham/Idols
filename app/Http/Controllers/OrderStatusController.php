<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    public function list()
    {
        $statuses = OrderStatus::orderBy('id', 'DESC')->get();
        return view('templates.pages.order_status_list', compact('statuses'));
    }

    public function add()
    {
        return view('templates.pages.forms.order_status_form');
    }

    public function delete($id)
    {
        $status = OrderStatus::where('id', $id)->delete();
        if ($status) {
            return redirect()->back()->with('success', 'Status deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $status = OrderStatus::where('id', $id)->first();
        if (!$status) {
            return redirect()->back()->with('error', 'Status not exist!!!');
        }
        return view('templates.pages.forms.order_status_form', compact('status'));
    }

    public function editSubmit(Request $req)
    {
        $status = OrderStatus::where('id', $req->id)->first();

        if (!$status) {
            return redirect()->back()->with('error', 'No status found!');
        }

        $status->name = $req->name;

        if ($status->save()) {
            return redirect()->route('order.status.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('order.status.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $status = OrderStatus::create($InsertData);

        if ($status) {
            return redirect()->route('order.status.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('order.status.list')->with('error', 'Something went wrong');
        }
    }
}
