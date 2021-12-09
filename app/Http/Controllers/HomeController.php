<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMailable;
use App\Models\Business;
use App\Models\Certificado;
use App\Models\Configuration;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\Participant;
use App\Models\Question;
use App\Models\QuestionsResponse;
use App\Models\Slider;
use App\Models\User;
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

        $customer = new Customer();
        $customer->name         = $request->name;
        $customer->last_name    = $request->last_name;
        $customer->email        = $request->email;
        $customer->telephone    = $request->telephone ;
        $customer->message      = $request->message ;

        $customer->save();

        return redirect()->route('contact')->with('info','Su mensaje a sido enviado con éxito');
    }
    public function autentication()
    {
        $configurations = Configuration::where('active', 1)->first();
        if (!empty($_GET['code']) ) {
            $code_tele = strpos($_GET['code'], 'T');
            $code_email = strpos($_GET['code'], 'E');

            if ($code_tele) {
                $strin = explode('T',$_GET['code']);
                User::where('active', 1)->where('id', $strin[1])->update([
                    'confirme_telephone' => 1,
                ]);
            }elseif ($code_email) {
                $strin = explode('E',$_GET['code']);
                User::where('active', 1)->where('id', $strin[1])->update([
                    'confirme_email'=>1,
                ]);
            }else{
                return view('errors.404');
            }
            $user = User::where('active',1)->where('id',$strin[1])->first();
            if ($user->confirme_telephone == 1 && $user->confirme_email == 1) {
                $data = array(
                    "name"=> $user->name,
                    "last_name"=> $user->last_name,
                    "email"=> $user->email,
                    "telephone"=> $user->telephone,
                    "message"=> 'Su número telefonico y su correo electronico a sido confirmado, su usuario y contraseña es su DNI.',
                    "email_from"=>$configurations->sender,
                    "view"=>"confirmation",
                    "subject"=>"Confirmacion"

                );
                $mail = new ContactMailable($data);
                Mail::to($user->email)->send($mail);
            }
            $result = array(
                'id'                =>$user->id,
                'last_name'         =>$user->last_name,
                'name'              =>$user->name,
                'dni'               =>$user->dni,
                'email'             =>$user->email,
                'telephone'         =>$user->telephone,
                'confirme_telephone'=>$user->confirme_telephone,
                'confirme_email'    =>$user->confirme_email,

            );

            return view('frontend.public.autentication', compact('configurations','result'));
        }
        return view('errors.404');
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
        $configurations = Configuration::where('active', 1)->first();
        $value=1;
        if ($request->ajax()) {

            $certificado = Certificado::where('certificados.active',1)->where('users.dni',$request->dni)->where('users.active',1)
                ->join("users", "users.id", "=", "certificados.user_id")
                ->select("certificados.description_cours", "certificados.date", "certificados.status", "certificados.certificado_id", "users.*")
                ->paginate(5);

            if ($certificado['data']=='' || $certificado['data']==null) {
                $value = 2;
            }

            return response()->json(view('frontend.public.list_certificate', compact('certificado','configurations','value'))->render());
        }

    }
    public function certificadoPDF($number)
    {
        // $participant = Participant::where('dni', $number)->where('active',1)->first();
        $certificado = Certificado::where('certificado_id',$number)->where('active',1)->first();
        $instructor = Instructor::where('active',1)->where('instructor_id',$certificado->instructor_id)
        ->first();

        $instructor = Instructor::where('instructors.active',1)->where('instructors.instructor_id',$certificado->instructor_id)->where('users.active',1)
            // ->where('participants.active',1)
            ->join("users", "users.id", "=", "instructors.user_id")
            ->select("instructors.*","users.*")
            ->first();


        $participant = Participant::where('participant_id', $certificado->participant_id)->where('active',1)->first();
        $user = User::where('active',1)->where('id',$certificado->user_id)->first();
        setlocale(LC_TIME, "spanish");
        $fecha = $certificado->date;
        $fecha = str_replace("/", "-", $fecha);
        $newDate = date("d-m-Y", strtotime($fecha));
        $mesDesc = strftime("%d de %B del %Y", strtotime($newDate));
        $year = strftime("%Y", strtotime($newDate));
        $cip = '';
        if ($instructor->cip>0) {
            $cip = 'REG. CIP '.$instructor->cip;
        }
        // return $cip;
        $json = array(
            'name'=>$user->name,
            'last_name'=>$user->last_name,
            'document'=>$user->dni,
            'description'=>$certificado->description_cours,
            'date_1'=>'Realizado el '.$mesDesc.',',
            'date_2'=>'con una duración '.$certificado->hour.' horas efectivas.',
            'name_firm'=>$instructor->name.' '.$instructor->last_name,
            'cargo_firm'=>$instructor->description,
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            'number'=>''.$year.' - 00'.$certificado->certificado_id,
            'cip'=>$cip,
            'img_firm'=>$instructor->img_firm
        );
        $pdf = PDF::loadView('pdf.certificado', compact('json'));
        return $pdf->download('certificado.pdf');
    }
    public function viewPDF()
    {
        // -----
        $url = url('/public/assets/fonts/calibre/Calibre-Regular.ttf');
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
        return view('pdf.certificado', compact('json','url'));
    }
    public function helper()
    {

        return test();
    }
    public function token()
    {
        # code...
        if (!empty($_GET['code']) || !empty($_GET['state']) ) {
            return response()->json([
                'code'=>$_GET['code'],
                'state'=>$_GET['state']
            ]);
        }
        /*if (!empty($_GET['tenant']) || !empty($_GET['tenant']) ) {
            return response()->json([
                'tenant'=>$_GET['tenant'],
                'tenant'=>$_GET['tenant']
            ]);
        }*/
        return 'error';
    }
    public function tokenLogout()
    {
        return 'logout';
    }
    public function msgSend(Request $request)
    {
        $msg = $request->chat;
        $question = Question::where('description',$msg)->first();
        // $question_response = Question::where('description',$msg)->first();
        $img_chat = asset('uploads/public/img-Alexa.png');
        $results = QuestionsResponse::where('questions_responses.active',1)->where('responses.active',1)->where('questions.active',1)->where('questions.description',$msg)
            ->join("questions", "questions.question_id", "=", "questions_responses.question_id")
            ->join("responses", "responses.response_id", "=", "questions_responses.response_id")
            ->select("responses.*", "questions_responses.*")
            ->first();

        if (isset($msg)) {

            $msg = strtolower($msg);

            return response()->json([
                'success'=>true,
                'status'=>200,
                'response_msg'=>$results,
                'img_chat'=>$img_chat
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
                'response_msg'=>$results
            ]);
        }


    }
}
