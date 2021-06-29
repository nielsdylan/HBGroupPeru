<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMailable;
use App\Models\Business;
use App\Models\Configuration;
use App\Models\Event;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $sliders =  Slider::where('active', 1)->take(3)->get();
        $configurations = Configuration::where('active', 1)->first();
        $business = Business::where('active', 1)->get();
        return view('frontend.public.index', compact('sliders', 'configurations', 'business'));
    }
    public function us()
    {
        $configurations = Configuration::where('active', 1)->first();
        return view('frontend.public.us',compact('configurations'));
    }
    public function services()
    {
        $configurations = Configuration::where('active', 1)->first();
        return view('frontend.public.services',compact('configurations'));
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
    public function autentication()
    {
        $configurations = Configuration::where('active', 1)->first();
        return view('frontend.public.autentication', compact('configurations'));
    }
    public function calendar()
    {
        $configurations = Configuration::where('active', 1)->first();
        $events =   Event::get();
        return view('frontend.public.calendar', compact('configurations', 'events'));
    }
    public function certificateView()
    {
        $configurations = Configuration::where('active', 1)->first();
        return view('frontend.public.certificate', compact('configurations'));
    }
    public function certificadoPDF()
    {
        // para obtner la imagen y convertirlo en base 64 y poder pintarlo en el pdf
        $img_logo = storage_path('assets/img/logo_snc.png');
        $img_logo = str_replace('storage','public',$img_logo);
        $img_logo = file_get_contents($img_logo);
        $img_logo = base64_encode($img_logo);
        // -----
        // para obtner la imagen - liston y convertirlo en base 64 y poder pintarlo en el pdf
        $img_liston = storage_path('assets/img/liston-sf-hb.png');
        $img_liston = str_replace('storage','public',$img_liston);
        $img_liston = file_get_contents($img_liston);
        $img_liston = base64_encode($img_liston);
        // -----
        // para obtner la imagen - firma y convertirlo en base 64 y poder pintarlo en el pdf
        $img_firma = storage_path('assets/img/firma-hb.png');
        $img_firma = str_replace('storage','public',$img_firma);
        $img_firma = file_get_contents($img_firma);
        $img_firma = base64_encode($img_firma);
        // -----
        // para obtner la imagen - sello y convertirlo en base 64 y poder pintarlo en el pdf
        $img_sello = storage_path('assets/img/sello-hb.png');
        $img_sello = str_replace('storage','public',$img_sello);
        $img_sello = file_get_contents($img_sello);
        $img_sello = base64_encode($img_sello);
        // -----
        // para obtner la imagen - fondo y convertirlo en base 64 y poder pintarlo en el pdf
        $img_fondo = storage_path('assets/img/fondo-hb.png');
        $img_fondo = str_replace('storage','public',$img_fondo);
        $img_fondo = file_get_contents($img_fondo);
        $img_fondo = base64_encode($img_fondo);
        // -----
        $json = array(
            'name'=>'Niels Dylan',
            'last_name'=>'Quispe Peralta',
            'document'=>'74250891',
            'description'=>'Supervivencia en el mar y rescate de hombre al agua',
            'date_1'=>'Realizado el 21 de Mayo del 2021,',
            'date_2'=>'con una duración Cuatro (04) horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            'number'=>'2021-0051'
        );
        $pdf = PDF::loadView('pdf.certificado', compact('json','img_logo','img_liston','img_firma','img_sello','img_fondo'));
        return $pdf->download('certificado.pdf');
    }
    public function viewPDF()
    {
        // para obtner la imagen - logo y convertirlo en base 64 y poder pintarlo en el pdf
        $img_logo = storage_path('assets/img/logo_snc.png');
        $img_logo = str_replace('storage','public',$img_logo);
        $img_logo = file_get_contents($img_logo);
        $img_logo = base64_encode($img_logo);
        // -----

        // para obtner la imagen - liston y convertirlo en base 64 y poder pintarlo en el pdf
        $img_liston = storage_path('assets/img/liston-sf-hb.png');
        $img_liston = str_replace('storage','public',$img_liston);
        $img_liston = file_get_contents($img_liston);
        $img_liston = base64_encode($img_liston);
        // -----
        // para obtner la imagen - firma y convertirlo en base 64 y poder pintarlo en el pdf
        $img_firma = storage_path('assets/img/firma-hb.png');
        $img_firma = str_replace('storage','public',$img_firma);
        $img_firma = file_get_contents($img_firma);
        $img_firma = base64_encode($img_firma);
        // -----
        // para obtner la imagen - firma y convertirlo en base 64 y poder pintarlo en el pdf
        $img_sello = storage_path('assets/img/sello-hb.png');
        $img_sello = str_replace('storage','public',$img_sello);
        $img_sello = file_get_contents($img_sello);
        $img_sello = base64_encode($img_sello);
        // -----
        // para obtner la imagen - fondo y convertirlo en base 64 y poder pintarlo en el pdf
        $img_fondo = storage_path('assets/img/fondo-hb.png');
        $img_fondo = str_replace('storage','public',$img_fondo);
        $img_fondo = file_get_contents($img_fondo);
        $img_fondo = base64_encode($img_fondo);
        // -----
        $json = array(
            'name'=>'Niels Dylan',
            'last_name'=>'Quispe Peralta',
            'document'=>'74250891',
            'description'=>'Supervivencia en el mar y rescate de hombre al agua',
            'date_1'=>'Realizado el 21 de Mayo del 2021,',
            'date_2'=>'con una duración Cuatro (04) horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',

            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            'number'=>'2021-0051'
        );
        return view('pdf.certificado', compact('json', 'img_logo', 'img_liston','img_firma','img_sello','img_fondo'));
    }
}
