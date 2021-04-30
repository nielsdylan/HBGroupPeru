<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $sliders =  Slider::where('active', 1)
                    ->take(3)
                    ->get();
        return view('frontend.public.index', compact('sliders'));
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
