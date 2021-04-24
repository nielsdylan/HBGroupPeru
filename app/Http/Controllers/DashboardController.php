<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //fun
    public function dashboard()
    {
        return view('backend.private.dashboard');
    }
}
