<?php

namespace App\Http\Controllers;

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
        return view('templates.pages.settings',compact('pageSettings','years'));
    }
}
