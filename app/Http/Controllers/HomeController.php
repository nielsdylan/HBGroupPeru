<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMailable;
use App\Models\Business;
use App\Models\Certificado;
use App\Models\Configuration;
use App\Models\Event;
use App\Models\Participant;
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
        $certificado='';
        $message='';
        if (!empty($_GET['page']) ) {

            $certificado = Certificado::where('certificados.active',1)
                ->where('certificados.participant_id',session('list_certificado')['id'])
                ->where('participants.active',1)
                ->join("participants", "participants.participant_id", "=", "certificados.participant_id")
                ->select("participants.*", "certificados.description_cours", "certificados.date", "certificados.certificado_id")
                ->paginate(5);
        }

        $configurations = Configuration::where('active', 1)->first();

        return view('frontend.public.certificate', compact('configurations','certificado','message'));
    }
    public function certificateList(Request $request)
    {

        $certificado='';
        $message='';
        $configurations = Configuration::where('active', 1)->first();
        $participant = Participant::where('dni',$request->dni)
            ->where('active',1)
            ->first();
        if ($participant) {

            $json_user = array(
                'id'=>$participant->participant_id,
                'dni'=>$request->dni,
            );
            $request->session()->put('list_certificado',$json_user);
            $certificado = Certificado::where('certificados.active',1)
                ->where('certificados.participant_id', session('list_certificado')['id'])
                ->where('participants.active',1)
                ->join("participants", "participants.participant_id", "=", "certificados.participant_id")
                ->select("participants.*", "certificados.description_cours", "certificados.date", "certificados.certificado_id")
                ->paginate(5);

            if (count($certificado)==0) {
                $message='No cuenta con certificado';
            }
            return view('frontend.public.certificate', compact('configurations','certificado','message'));
        }
        return view('frontend.public.certificate', compact('configurations','certificado','message'));
        // return redirect()->route('contact')->with('info','Su mensaje a sido enviado con éxito');
    }
    public function certificadoPDF($number)
    {
        // $participant = Participant::where('dni', $number)->where('active',1)->first();
        $certificado = Certificado::where('certificado_id',$number)->where('active',1)->first();
        // return $certificado;
        $participant = Participant::where('participant_id', $certificado->participant_id)->where('active',1)->first();
        setlocale(LC_TIME, "spanish");
        $fecha = $certificado->date;
        $fecha = str_replace("/", "-", $fecha);
        $newDate = date("d-m-Y", strtotime($fecha));
        $mesDesc = strftime("%d de %B del %Y", strtotime($newDate));
        $year = strftime("%Y", strtotime($newDate));

        // return $mesDesc;
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
        // para obtner la imagen - fondo y convertirlo en base 64 y poder pintarlo en el pdf
        $img_sello_whitw = storage_path('assets/img/sello-fondo-hb.png');
        $img_sello_whitw = str_replace('storage','public',$img_sello_whitw);
        $img_sello_whitw = file_get_contents($img_sello_whitw);
        $img_sello_whitw = base64_encode($img_sello_whitw);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_telephone = storage_path('assets/img/telephone-cetificado.png');
        $img_telephone = str_replace('storage','public',$img_telephone);
        $img_telephone = file_get_contents($img_telephone);
        $img_telephone = base64_encode($img_telephone);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_message = storage_path('assets/img/message-certificado.png');
        $img_message = str_replace('storage','public',$img_message);
        $img_message = file_get_contents($img_message);
        $img_message = base64_encode($img_message);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_web = storage_path('assets/img/web-certificado.png');
        $img_web = str_replace('storage','public',$img_web);
        $img_web = file_get_contents($img_web);
        $img_web = base64_encode($img_web);
        // -----
        $json = array(
            'name'=>$participant->name,
            'last_name'=>$participant->last_name,
            'document'=>$participant->dni,
            'description'=>$certificado->description_cours,
            'date_1'=>'Realizado el '.$mesDesc.',',
            'date_2'=>'con una duración Cuatro (04) horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            'number'=>''.$year.' - 00'.$certificado->certificado_id
        );
        $pdf = PDF::loadView('pdf.certificado', compact('json','img_logo','img_liston','img_firma','img_sello','img_fondo','img_sello_whitw','img_telephone','img_message','img_web'));
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
        // para obtner la imagen - fondo y convertirlo en base 64 y poder pintarlo en el pdf
        $img_sello_whitw = storage_path('assets/img/sello-fondo-hb.png');
        $img_sello_whitw = str_replace('storage','public',$img_sello_whitw);
        $img_sello_whitw = file_get_contents($img_sello_whitw);
        $img_sello_whitw = base64_encode($img_sello_whitw);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_telephone = storage_path('assets/img/telephone-cetificado.png');
        $img_telephone = str_replace('storage','public',$img_telephone);
        $img_telephone = file_get_contents($img_telephone);
        $img_telephone = base64_encode($img_telephone);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_message = storage_path('assets/img/message-certificado.png');
        $img_message = str_replace('storage','public',$img_message);
        $img_message = file_get_contents($img_message);
        $img_message = base64_encode($img_message);
        // -----
        // para obtner la imagen - telephone y convertirlo en base 64 y poder pintarlo en el pdf
        $img_web = storage_path('assets/img/web-certificado.png');
        $img_web = str_replace('storage','public',$img_web);
        $img_web = file_get_contents($img_web);
        $img_web = base64_encode($img_web);
        // -----
        $json = array(
            'name'=>'Niels Dylan',
            'last_name'=>'Quispe Peralta',
            'document'=>'74250891',
            'description'=>'Control de Energías Peligrosas (Bloqueo y Etiquetado / Consignación de Equipos)',
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
        return view('pdf.certificado', compact('json', 'img_logo', 'img_liston','img_firma','img_sello','img_fondo','img_sello_whitw','img_telephone','img_message','img_web'));
    }
}
