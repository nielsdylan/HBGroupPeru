<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('backend.private.group.group_list');
    }
}
