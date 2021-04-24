<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function setting()
    {
        # code...
        return view('backend.private.configuration.configuration');
    }
}
