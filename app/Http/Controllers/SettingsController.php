<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function viewSettings()
    {
        $pageSettings['title'] = "Settings";
        return view('templates.pages.settings',compact('pageSettings'));
    }
}
