<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    private function Modelyears()
    {
        $currentYear = date('Y');
        $years = [];
        $years[] = $currentYear;
        for ($i = 1; $i <= 4; $i++) {
            $years[] = $currentYear - $i;
        }
        for ($i = 1; $i <= 4; $i++) {
            $years[] = $currentYear + $i;
        }
        sort($years);
        return $years;
    }

    public function viewSettings()
    {
        $pageSettings['title'] = "Settings";
        $years = $this->Modelyears();
        $settings = Setting::first();
        if(!$settings)
        {
            $settings = null;
        }
        return view('templates.pages.settings',compact('pageSettings','years','settings'));
    }

    public function updateSettings(Request $req)
    {
        $settings = Setting::first();
        if(!$settings)
        {
            $settings = new Setting();
        }
        $settings->name = $req->name;
        $settings->description = $req->description;
        $settings->email = $req->email;
        $settings->phone = $req->phone;
        $settings->model = $req->model;
        if ($settings->save()) {
            return redirect()->route('settings')->with('success', 'Successfully updated');
        } else {
            return redirect()->route('settings;')->with('error', 'Something went wrong');
        }

    }


}
