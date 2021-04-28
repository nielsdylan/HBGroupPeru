<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        return view('frontend.public.index');
    }
    // public function index()
    // {
    //     return view('frontend.public.index');
    // }
    public function us()
    {
        return view('frontend.public.us');
    }
    public function services()
    {
        return view('frontend.public.services');
    }
    public function contact(){
        return view('frontend.public.contact');
    }
}
