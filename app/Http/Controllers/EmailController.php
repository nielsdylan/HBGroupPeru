<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //
    public function index()
    {
        return view('frontend.private.mail.components.index');
    }
    public function create()
    {

        $asignatures    = Asignature::where('active',1)->get();
        return view('frontend.private.mail.components.create', compact('asignatures'));
    }
}
