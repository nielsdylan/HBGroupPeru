<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMailable;
use App\Models\Configuration;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $configurations = Configuration::where('active', 1)->first();
        return view('frontend.public.contact', compact('configurations'));
    }
    public function sendEmail(Request $request)
    {
        //para la empresa
        $configurations = Configuration::where('active', 1)->first();
        $data = array(
            "name"=> $request->name,
            "last_name"=> $request->last_name,
            "email"=> $request->email,
            "telephone"=> $request->telephone,
            "message"=> $request->message,
            "email_from"=>$request->email,
            "view"=>"contact",
            "subject"=>"Contactanos"

        );
        $mail = new ContactMailable($data);
        Mail::to($configurations->sender)->send($mail);

        //para el cliente
        $data = array(
            "name"=> $request->name,
            "last_name"=> $request->last_name,
            "email"=> $request->email,
            "telephone"=> $request->telephone,
            "message"=> $request->message,
            "email_from"=>$configurations->sender,
            "view"=>"client",
            "subject"=>"HB Group Perú"

        );
        $mail = new ContactMailable($data);
        Mail::to($request->email)->send($mail);

        return redirect()->route('contact')->with('info','Su mensaje a sido enviado con éxito');
    }
}
