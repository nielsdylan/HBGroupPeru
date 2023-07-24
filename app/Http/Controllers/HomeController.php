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
use App\Models\Organizer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\QuestionsResponse;
use App\Models\Slider;
use App\Models\User;
// use Barryvdh\DomPDF\PDF ;
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
        // $data = array(
        //     "name"=> $request->name,
        //     "last_name"=> $request->last_name,
        //     "email"=> $request->email,
        //     "telephone"=> $request->telephone,
        //     "message"=> $request->message,
        //     "email_from"=>$request->email,
        //     "view"=>"contact",
        //     "subject"=>"Contactanos"

        // );
        // $mail = new ContactMailable($data);
        // Mail::to($configurations->sender)->send($mail);
        $organizer = Organizer::where('active',1)->where('organizer_id',2)->first();
        $refresh_token = $this->tokenTeams($organizer->refresh_token);
        $refresh_token = json_decode($refresh_token);
        $json = array(
            "message"=>array(
                "subject"=> "CONSULTAR",
                "body"=>array(
                    "contentType"=> "HTML",
                    "content"=> "<p>Apellidos y Nombres: ".$request->last_name." ".$request->name."</p><p> Email: ".$request->email."</p><p>Celular: ".$request->telephone."</p><p>".$request->message."</p>"
                ),
                "toRecipients"=>array(
                    array(
                        "emailAddress"=>array(
                            "address"=> "comercial@hbgroup.pe"
                        )
                    )
                ),
                "ccRecipients"=>array(
                    array(
                        "emailAddress"=>array(
                            "address"=> "abejarano@hbgroup.pe"
                        )
                    )
                )
            ) ,
            "saveToSentItems"=> "true"

        );

        $json = json_encode($json);
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/me/sendmail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>''.$json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$refresh_token->access_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

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
            // return $user;
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
                'change_email'    =>$user->change_email,
                'change_phone'    =>$user->change_phone,

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

            $certificado = Certificado::where('certificados.active',1)->paginate(5);
        }

        $configurations = Configuration::where('active', 1)->first();

        return view('frontend.public.certificate', compact('configurations','certificado','message'));
    }
    public function certificateList(Request $request)
    {
        $configurations = Configuration::where('active', 1)->first();
        $value=1;
        if ($request->ajax()) {

            // $certificado = Certificado::where('certificados.active',1)->where('users.dni',$request->dni)->where('users.active',1)
            //     ->join("users", "users.id", "=", "certificados.user_id")
            //     ->select("certificados.description_cours", "certificados.date", "certificados.status", "certificados.certificado_id", "users.*")
            //     ->paginate(5);

            $certificado = Certificado::where('numero_documento','like','%'.$request->dni.'%')->paginate(5);
            
            // return $request;exit;
            if ($certificado['data']=='' || $certificado['data']==null) {
                $value = 2;
            }

            return response()->json(view('frontend.public.list_certificate', compact('certificado','configurations','value'))->render());
        }

    }
    public function certificadoPDF($number)
    {
        
        $instructor = (object)array(
            "name"=>"HELARD JOHN",
            "last_name"=>"BEJARANO OTAZU",
            "description"=>"Gerente General",
            "img_firm"=>"1638456633.png",
            "cip"=>0,
        );
        // return $instructor->name;exit;
        // $participant = Participant::where('dni', $number)->where('active',1)->first();
        $certificado = Certificado::where('certificado_id',$number)->first();
        // $instructor = Instructor::where('active',1)->where('instructor_id',$certificado->instructor_id)
        // ->first();
        
        // $instructor = Instructor::where('instructors.active',1)
        // ->where('instructors.instructor_id',$certificado->instructor_id)
        // ->where('users.active',1)
        // // ->where('participants.active',1)
        // ->join("users", "users.id", "=", "instructors.user_id")
        // ->select("instructors.*","users.*")
        // ->first();
        // $user_instructor =  User::where('id',$instructor->user_id)->first();
        // return [$user_instructor];exit;
        
        $participant = Participant::where('participant_id', $certificado->participant_id)->where('active',1)->first();
        $user = User::where('active',1)->where('id',$certificado->user_id)->first();
        setlocale(LC_TIME, "spanish");
        $fecha_oficial = $certificado->fecha_curso;
        $fecha = str_replace("/", "-", $fecha_oficial);
        $newDate = date("d-m-Y", strtotime($fecha));
        $mesDesc = strftime("%d de %B del %Y", strtotime($newDate));
        $year = strftime("%Y", strtotime($newDate));
        $cip = '---';
        
        // if ($instructor->cip>0) {
        //     $cip = 'REG. CIP '.$instructor->cip;
        // }
        // return $cip;
        $descripcion = ($certificado->curso?$certificado->curso:'-');
        $json = array(
            'name'=>strtoupper($certificado->nombres),
            'last_name'=>strtoupper($certificado->apellido_paterno).' '.strtoupper($certificado->apellido_materno),
            'document'=>$certificado->numero_documento,
            'description'=>$descripcion,
            'date_1'=>'Realizado el '.$mesDesc.',',
            'date_2'=>'con una duración '.$certificado->duracion.' horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            // 'number'=>''.$year.' - 00'.$certificado->certificado_id,
            'number'=>$certificado->cod_certificado,
            'cip'=>$cip,
            'img_firm'=>'1638635074.png',
            'business_curso'=>$certificado->empresa,
            'comentario'=>$certificado->comentario,
            'fecha_vencimiento'=>date("d/m/Y", strtotime($certificado->fecha_vencimiento)) ,
        );

        $pdf = \PDF::loadView('pdf.certificado', compact('json'));
        // $pdf = PDF::loadView('pdf.certifi', compact('json'));
        return $pdf->download(date("Y-m-d").'-'.strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'.strtoupper($certificado->nombres).'-'.$certificado->cod_certificado.'.pdf');
        // return $pdf->download('certifi.pdf');;
    }
    public function viewPDF()
    {
        $instructor = (object)array(
            "name"=>"HELARD JOHN",
            "last_name"=>"BEJARANO OTAZU",
            "description"=>"Gerente General",
            "img_firm"=>"1638456633.png",
            "cip"=>0,
        );
        // -----
        $certificado = Certificado::where('certificado_id',155)->where('active',1)->first();
        // $instructor = Instructor::where('active',1)->where('instructor_id',$certificado->instructor_id)
        // ->first();

        // $instructor = Instructor::where('instructors.active',1)->where('instructors.instructor_id',$certificado->instructor_id)->where('users.active',1)
        //     // ->where('participants.active',1)
        //     ->join("users", "users.id", "=", "instructors.user_id")
        //     ->select("instructors.*","users.*")
        //     ->first();


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

        $url = url('/public/assets/fonts/calibre/Calibre-Regular.ttf');
        $json = array(
            'name'=>strtoupper('Niels Dylan'),
            'last_name'=>strtoupper('Quispe Peralta'),
            'document'=>'74250891',
            'description'=>'Control de Energías Peligrosas (Bloqueo y Etiquetado / Consignación de Equipos)',
            'date_1'=>'Realizado el 21 de Mayo del 2021,',
            'date_2'=>'con una duración Cuatro (04) horas efectivas.',
            'name_firm'=>$instructor->name.' '.$instructor->last_name,
            'cargo_firm'=>$instructor->description,
            'business_firm'=>'HB GROUP PERU S.R.L.',

            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            'number'=>'2021-0051',
            'business_curso'=>strtoupper('Tramarsa'),

            'cip'=>$cip,
            'img_firm'=>$instructor->img_firm
        );
        return view('pdf.certifi', compact('json','url'));
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
    public function changeValidation(Request $request)
    {

        $rand_telephone = uniqid();
        $rand_email = uniqid();
        $user = User::where('active',1)->where('id',$request->id)->first();
        $rand_telephone = $rand_telephone.'T'.$user->id;
        $rand_email = $rand_email.'E'.$user->id;
        $message='';
        $message_email_1='El propósito de este mensaje es de confirmar su correo electrónico, el mismo mensaje se le envió a su número telefónico con el mismo propósito.';
        $message_email_2='Por favor confirmar ambos medios de comunicación para poder ingresar al curso gracias por su comprensión.';
        $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';
        $button_email = 'Click para verificar su correo electrónico.';
        $configurations = Configuration::where('active', 1)->first();

        if ($user) {
            switch ($request->type) {
                case 'email':
                    User::where('active', 1)->where('id', $request->id)->update([
                        'email' => $request->value,
                        'change_email' => 1,
                        'code_email'=>$rand_email,
                        'send_email'=>1
                    ]);
                    $message_result = 'Se envió el correo electrónico con éxito';
                    $data = array(
                        "name"=> $user->name,
                        "last_name"=> $user->last_name,
                        "email"=> $user->email,
                        "message_1"=> 'El propósito de este mensaje es de confirmar su correo electrónico, el mismo mensaje se le envió a su número telefónico con el mismo propósito.',
                        "message_2"=> $message_email_2,
                        "message_3"=> $message_email_3,
                        "button"=>$button_email,
                        "email_from"=>$configurations->sender,
                        "view"=>"verification",
                        "subject"=>"HB GROUP PERÚ-AULA VIRTUAL",
                        "rand"=>$rand_email.'E'.$user->id

                    );
                    $this->sendEmailValidation($data);
                break;

                case 'phone':
                    User::where('active', 1)->where('id', $request->id)->update([
                        'telephone' => $request->value,
                        'change_phone' => 1,
                        'code_telephone' => $rand_telephone,
                        'send_telephone'=>1
                    ]);
                    $message_result = 'Se envió el mensaje de texto con éxito';

                    $phono=$user->telephone ;
                    $message="Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."";
                    $json_game_net = $this->gameNet($phono, $message);
                    User::where('active', 1)->where('id', $user->id)->update([
                        'json_game_net' => $json_game_net,
                    ]);
                break;
            }

            return response()->json([
                'success'=>true,
                'status'=>200,
                'type'=>$request->type,
                'message'=>$message_result
            ]);
        }
    }
    public function sendEmailValidation($data)
    {
        # code...
        $mail = new ContactMailable($data);
        Mail::to($data['email'])->send($mail);
    }
    public function changeValidationAfirmation(Request $request)
    {
        switch ($request->type) {
            case 'email':
                User::where('active', 1)->where('id', $request->id)->update([
                    'change_email' => 1
                ]);
            break;

            case 'phone':
                User::where('active', 1)->where('id', $request->id)->update([
                    'change_phone' => 1
                ]);
            break;
        }
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);

    }
    public function gameNet($phono, $message)
    {

        //Ejemplo PHP.  Para verificar libreria CURL use phpinfo()

        $apikey = "O4R7X3PGDJCS";
        $apicard = "5353000223";
        $fields_string = "";
        $smsnumber = $phono;
        $smstext = $message;
        $smstype = "0"; // 0: remitente largo, 1: remitente corto
        $shorturl = "0"; // acortador URL

        //Preparamos las variables que queremos enviar
        $url = 'http://api2.gamacom.com.pe/smssend'; // Para HTTPS $url = 'https://api3.gamanet.pe/smssend';
        $fields = array(
            'apicard'=>urlencode($apicard),
            'apikey'=>urlencode($apikey),
            'smsnumber'=>urlencode($smsnumber),
            'smstext'=>urlencode($smstext),
            'smstype'=>urlencode($smstype),
            'shorturl'=>urlencode($shorturl)
        );

        //Preparamos el string para hacer POST (formato querystring)
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        $fields_string = rtrim($fields_string,'&');


        //abrimos la conexion
        $ch = curl_init();

        //configuramos la URL, numero de variables POST y los datos POST
        curl_setopt($ch,CURLOPT_URL,$url);
        //curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); //Descomentarlo si usa HTTPS
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

        //ejecutamos POST
        $result = curl_exec($ch);

        if($result===false){
            echo 'Curl error: '.curl_error($ch);
            exit();
        }

        //cerramos la conexion
        curl_close($ch);

        //Resultado
        $array = json_decode($result,true);
        return $array;
        // echo "error:".$array["message"];
        // echo "uniqueid:".$array["uniqueid"];


    }
    public function tokenTeams($refresh_token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'client_id=b57f99a3-d61e-4a74-a79e-aa91d4bc03d6&scope=user.read&client_secret=K4C7Q~Nh3hI1.ISsGuasCyoGRIIlkxGxOzbmX&grant_type=refresh_token&refresh_token='.$refresh_token.'&redirect_uri=https%3A%2F%2Fhbgroup.pe%2Ftoken',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: buid=0.AX0AFSpzYanp7UyxmM5mlR5hQaOZf7Ue1nRKp56qkdS8A9Z9AAA.AQABAAEAAAD--DLA3VO7QrddgJg7WevrubmlCuWp9TD2C1ChDRnWpr5j2nuKX9MfpfhBWqwfKinDauPn5rKYYyL8WxCf1aR090M48C690cz8OrCwn0jF-7nPpkmpcgm7cpMXJjTb8IAgAA; fpc=ArDA9pPZuqJKhADCdbCSXaEs2i1RAQAAAMmnrdgOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
