<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Imports\UsersImport;
use App\Mail\ContactMailable;
use App\Models\Asignature;
use App\Models\Business;
use App\Models\Configuration;
use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Document_type;
use App\Models\Participant;
use App\Models\Prefixe;
use App\Models\User;
use App\Models\UsersBusiness;
use App\Models\UsersGroup;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    //
    public function index()
    {

        $participants = UsersGroup::where('users.active',1)->where('users_groups.group_id',4)->where('users_businesses.active',1)
            ->join("users", "users.id", "=", "users_groups.user_id")
            ->join("users_businesses", "users_businesses.user_id", "=", "users.id")
            ->select("users.*", "users_businesses.name as business")
            ->get();

        $asignatures    = Asignature::where('active',1)->get();
        $business       = Business::where('active',1)->get();
        $cours          = Cours::where('active',1)->get();
        $prefixes       = Prefixe::get();
        $document_types = Document_type::where('active', 1)->get();
        return view('frontend.private.participants.index',
            compact(
                'participants',
                'asignatures',
                'business',
                'cours',
                'document_types',
                'prefixes'
            )
        );
    }
    public function create()
    {

        $asignatures    = Asignature::where('active',1)->get();
        $business       = Business::where('active',1)->get();
        $cours          = Cours::where('active',1)->get();
        $prefixes       = Prefixe::get();
        $document_types = Document_type::where('active', 1)->get();
        // return response()->json([
        //     $asignatures,
        //     $cours
        // ]);
        return view(
            'frontend.private.participants.create',
            compact(
                'asignatures',
                'business',
                'cours',
                'document_types',
                'prefixes'
            )
        );
    }
    public function store(Request $request)
    {
        $rand_telephone = uniqid();
        $rand_email = uniqid();


        $file = $request->file('file');
        $data_number_msm_text = array();
        $array = Excel::toArray(new UsersImport, $file);

        $success = true;
        foreach ($array[0] as $key => $value) {
            if ($key!=0) {
                if ($value[0]=='' || $value[0]==null) {
                    $success=false;
                }else{

                }
                if ($value[1]=='' || $value[1]==null) {
                    $success=false;
                }
                if ($value[2]=='' || $value[2]==null) {
                    $success=false;
                }
                if ($value[3]=='' || $value[3]==null) {
                    $success=false;
                }
                if ($value[4]=='' || $value[4]==null) {
                    $success=false;
                }
                if ($value[5]=='' || $value[5]==null) {
                    $success=false;
                }

            }
        }
        $participant_exclude_array=array();
        if ($success==true) {
            foreach ($array[0] as $key => $value) {
                $exist_cours_participant = false;
                if ($key!=0) {
                    $user = User::where('users.active', 1)->where('users.dni',$value[0])->where('users_groups.group_id',4)
                        ->join('users_groups', 'users.id','=','users_groups.user_id')
                        ->select('users.*')
                        ->first();

                    // $user = User::where('active',1)->where('dni',$value[0])->first();
                    if (!$user) {

                        $user = new User();
                        $user->name             = $value[3];
                        $user->email            = $value[4];
                        $user->password         = sha1($value[0]);
                        // $user->group_id         = 4;
                        $user->dni              = $value[0];
                        $user->last_name        = $value[1]." ".$value[2];
                        $user->telephone        = $value[5];
                        $user->create_by        = session('hbgroup')['user_id'];
                        $user->save();

                        User::where('active', 1)->where('id', $user->id)->update([
                            'code_telephone' => $rand_telephone.'T'.$user->id,
                            'code_email'=>$rand_email.'E'.$user->id,
                        ]);

                        $user_groups = new UsersGroup();
                        $user_groups->user_id   = $user->id;
                        $user_groups->group_id  = 4;
                        $user_groups->create_by = session('hbgroup')['user_id'];
                        $user_groups->save();

                        if ($request->send_email == 1) {
                            $message_email_1='El propósito de este mensaje es de confirmar su correo electrónico, el mismo mensaje se le envió a su número telefónico con el mismo propósito.';
                            $message_email_2='Por favor confirmar ambos medios de comunicación para poder ingresar al curso gracias por su comprensión.';
                            $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';
                            $button_email = 'Click para verificar su correo electrónico.';
                            $configurations = Configuration::where('active', 1)->first();
                            $data = array(
                                "name"=> $user->name,
                                "last_name"=> $user->last_name,
                                "email"=> $user->email,
                                "telephone"=> $user->telephone,
                                "message_1"=> $message_email_1,
                                "message_2"=> $message_email_2,
                                "message_3"=> $message_email_3,
                                "button"=>$button_email,
                                "email_from"=>$configurations->sender,
                                "view"=>"verification",
                                "subject"=>"HB GROUP PERÚ-AULA VIRTUAL",
                                "rand"=>$rand_email.'E'.$user->id

                            );
                            $mail = new ContactMailable($data);
                            Mail::to($data['email'])->send($mail);
                        }

                        if ($request->send_telephone == 1) {
                            array_push($data_number_msm_text,
                                array(
                                    "url"=>"Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."",
                                    "number"=>$user->telephone,
                                    "setLogin"=>"info@hbgroup.pe",
                                    "setPassword"=>"eb9ga5ty",
                                    "user_id"=>$user->id
                                )
                            );
                            // $data =array(
                            //     "message"=>"Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."",
                            //     "destination"=>$user->telephone,
                            //     "setLogin"=>"info@hbgroup.pe",
                            //     "setPassword"=>"eb9ga5ty"
                            // );

                            // $json_game_net = $array;
                            // User::where('active', 1)->where('id', $user->id)->update([
                            //     'json_game_net' => $json_game_net,
                            // ]);
                        }
                        User::where('active', 1)->where('id', $user->id)->update([
                            'send_email' => $request->send_email== 1 ? $request->send_email : 0,
                            'send_telephone' => $request->send_telephone == 1 ? $request->send_telephone : 0
                        ]);

                        // $participan = new Participant();
                        // $participan->user_id = $user->id;
                        // $participan->create_by = session('hbgroup')['user_id'];
                        // $participan->save();

                    }else{
                        // $participan = Participant::where('active',1)->where('user_id',$user->id)->first();
                        // $search_cours_participant = CoursParticipant::where('active',1)->where('cours_id',$request->course)->where('participant_id',$user->id)->first();
                        // if ($search_cours_participant) {
                        //     $exist_cours_participant = true;
                        // }

                    }

                    if ($exist_cours_participant == true) {
                        // array_push($participant_exclude_array,
                        //     array(
                        //         "dni"=>$value[0],
                        //         "last_name"=>$value[1],
                        //         "name"=>$value[2],
                        //     )
                        // );
                    }else{
                        // $cours = Cours::where('active',1)->where('cours_id',$request->course)->first();

                        // $cours_participant = new CoursParticipant();
                        // $cours_participant->asignature_id   = $request->asignature;
                        // $cours_participant->participant_id  = $user->participant_id;
                        // $cours_participant->cours_id        = $cours->cours_id ;
                        // $cours_participant->create_by       = session('hbgroup')['user_id'];
                        // $cours_participant->save();
                    }


                }
            }
        }
        $existen_status = 2;
        if (count($participant_exclude_array)>0) {
            $existen_status = 1;
        }
        if ($success == true) {
            return response()->json([
                'success'=>true,
                'status'=>200,
                'existen_status'=>$existen_status,
                'existen'=>$participant_exclude_array,
                'number_msm_text'=>$data_number_msm_text
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
            ]);
        }



    }
    public function edit(User $participante)
    {

        $business = UsersBusiness::where('active',1)->where('user_id',$participante->id)->first();
        $document_types = Document_type::where('active', 1)->get();
        $prefixes       = Prefixe::get();
        return view(
            'frontend.private.participants.edit',
            compact(
                'participante',
                'business',
                'document_types',
                'prefixes',
            )
        );
    }
    public function update(Request $request, User $participante)
    {

        $user = $participante;

        $message_email_1='El propósito de este mensaje es de confirmar su correo electrónico, el mismo mensaje se le envió a su número telefónico con el mismo propósito.';
        $message_email_2='Por favor confirmar ambos medios de comunicación para poder ingresar al curso gracias por su comprensión.';
        $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';
        $button_email = 'Click para verificar su correo electrónico.';
        $configurations = Configuration::where('active', 1)->first();
        if ($user->send_email == 0 && $request->send_email ==1) {
            # code...
            $data = array(
                "name"=> $request->name,
                "last_name"=> $request->last_name,
                "email"=> $request->email,
                "telephone"=> $request->cell,
                "message_1"=> $message_email_1,
                "message_2"=> $message_email_2,
                "message_3"=> $message_email_3,
                "button"=>$button_email,
                "email_from"=>$configurations->sender,
                "view"=>"verification",
                "subject"=>"HB GROUP PERÚ-AULA VIRTUAL",
                "rand"=>$user->code_email

            );
            $this->sendEmail($data);

        }
        if ($user->send_telephone == 0 && $request->send_telephone == 1) {
            # code...

            // a qui telefono
            $phono=$request->cell;
            $message="Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$user->code_telephone."";
            $json_game_net = $this->gameNet($phono, $message);
            User::where('active', 1)->where('id', $user->id)->update([
                'json_game_net' => $json_game_net,
            ]);

        }
        User::where('active', 1)->where('id', $participante->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'document_type_id' => $request->document_type_id,
            'dni' => $request->dni,
            'last_name' => $request->last_name,
            'telephone' => $request->cell,
            'prefixe_id' => $request->prefixe_id,
            'stall' => $request->stall,
            'send_email' => $request->send_email== 1 ? $request->send_email : 0,
            'send_telephone' => $request->send_telephone == 1 ? $request->send_telephone : 0,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        $hoy = date('Y-m-d H:i:s');
        // return $hoy;
        UsersBusiness::where('active', 1)->where('user_id', $user->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$hoy,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        $users_business = new UsersBusiness();
        $users_business->user_id   = $user->id;
        $users_business->name       = $request->business;
        $users_business->save();

        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($participante)
    {
        $participante = User::where('users.active', 1)
        ->where('users.id', $participante)
        ->where('document_types.active', 1)
        ->join('document_types', 'users.document_type_id','=','document_types.document_type_id')
        ->select('users.*', 'document_types.name as document')
        ->first();

        return view('frontend.private.participants.show',compact('participante')
        );
    }
    public function destroy(User $participante)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        // $participant = Participant::where('active',1)->where('user_id',$participante->id)->first();

        // Participant::where('active', 1)->where('participant_id', $participant->participant_id)->update([
        //     'active' => 0,
        //     'deleted_at'=>$fecha,
        //     'delete_by'=>session('hbgroup')['user_id']
        // ]);
        User::where('active', 1)->where('id', $participante->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function add(Request $request)
    {

        $rand_telephone = uniqid();
        $rand_email = uniqid();
        // $user = User::where('active',1)->where('dni',$request->dni)->first();

        $user = User::where('users.active', 1)->where('users.dni',$request->dni)->where('users_groups.group_id',4)
            ->join('users_groups', 'users.id','=','users_groups.user_id')
            ->select('users.*', 'users_groups.*' )
            ->first();


        $text='';
        $message_email_1='El propósito de este mensaje es de confirmar su correo electrónico, el mismo mensaje se le envió a su número telefónico con el mismo propósito.';
        $message_email_2='Por favor confirmar ambos medios de comunicación para poder ingresar al curso gracias por su comprensión.';
        $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';
        $button_email = 'Click para verificar su correo electrónico.';

        $button_email = 'Click para verificar su correo electronico.';
        $configurations = Configuration::where('active', 1)->first();
        if (!$user) {
            $user = new User();
            $user->name             = $request->name;
            $user->email            = $request->email;
            $user->password         = sha1($request->dni);
            // $user->group_id         = 4;
            $user->document_type_id = $request->document_type_id;
            $user->dni              = $request->dni;
            $user->last_name        = $request->last_name;
            $user->prefixe_id       = $request->prefixe_id;
            $user->telephone        = $request->cell;
            $user->stall        = $request->stall;

            // $user->code_telephone   = $rand_telephone;
            // $user->code_email       = $rand_email;
            if ($request->send_email) {
                $user->send_email   = $request->send_email;
            }
            if ($request->send_telephone) {
                $user->send_telephone= $request->send_telephone;
            }
            $user->create_by = session('hbgroup')['user_id'];
            $user->save();

            $user_group = new UsersGroup();
            $user_group->user_id = $user->id;
            $user_group->group_id = 4;
            $user_group->save();

            if ($request->send_email == 1) {

                $data = array(
                    "name"=> $request->name,
                    "last_name"=> $request->last_name,
                    "email"=> $request->email,
                    "telephone"=> $request->telephone,
                    "message_1"=> $message_email_1,
                    "message_2"=> $message_email_2,
                    "message_3"=> $message_email_3,
                    "button"=>$button_email,
                    "email_from"=>$configurations->sender,
                    "view"=>"verification",
                    "subject"=>"HB GROUP PERÚ-AULA VIRTUAL",
                    "rand"=>$rand_email.'E'.$user->id

                );
                $this->sendEmail($data);
            }

            if ($request->send_telephone == 1) {


                // a qui telefono
                $phono=$request->cell;
                $message="Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."";
                $json_game_net = $this->gameNet($phono, $message);
                User::where('active', 1)->where('id', $user->id)->update([
                    'json_game_net' => $json_game_net,
                ]);
            }
        }else{
            if ($user->send_email == 0 && $request->send_email ==1) {
                # code...
                $data = array(
                    "name"=> $request->name,
                    "last_name"=> $request->last_name,
                    "email"=> $request->email,
                    "telephone"=> $request->telephone,
                    "message_1"=> $message_email_1,
                    "message_2"=> $message_email_2,
                    "message_3"=> $message_email_3,
                    "button"=>$button_email,
                    "email_from"=>$configurations->sender,
                    "view"=>"verification",
                    "subject"=>"HB GROUP PERÚ-AULA VIRTUAL",
                    "rand"=>$rand_email.'E'.$user->id

                );
                $this->sendEmail($data);
                User::where('active', 1)->where('id', $user->id)->update([
                    'send_email' => $request->send_email,
                ]);
            }
            if ($user->send_telephone == 0 && $request->send_telephone == 1) {
                # code...
                // a qui telefono
                $phono=$request->cell;
                $message="Ingrese al link para verificar su número telefónico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."";
                $json_game_net = $this->gameNet($phono, $message);
                User::where('active', 1)->where('id', $user->id)->update([
                    'json_game_net' => $json_game_net,
                ]);
                User::where('active', 1)->where('id', $user->id)->update([
                    'send_telephone' => $request->send_telephone,
                ]);
            }
        }

        // $fecha = new DateTime();
        // $fecha->format('U = Y-m-d H:i:s');
        $hoy = date('Y-m-d H:i:s');
        // return $hoy;
        UsersBusiness::where('active', 1)->where('user_id', $user->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$hoy,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        $users_business = new UsersBusiness();
        $users_business->user_id   = $user->id;
        $users_business->name       = $request->business;
        $users_business->save();

        $rand_telephone = $rand_telephone.'T'.$user->id;
        $rand_email = $rand_email.'E'.$user->id;
        User::where('active', 1)->where('id', $user->id)->update([
            'code_telephone' => $rand_telephone,
            'code_email'=>$rand_email,
        ]);

        // $participan = new Participant();
        // $participan->user_id = $user->id;
        // $participan->create_by = session('hbgroup')['user_id'];
        // $participan->save();



        return response()->json([
            'success'=>true,
            'status'=>200,
            'telephone'=>$text
        ]);
    }
    public function sendTelephone($data)
    {
        # code...
        return sendText($data);
    }
    public function sendEmail($data)
    {
        # code...
        $mail = new ContactMailable($data);
        Mail::to($data['email'])->send($mail);
    }

    public function getPagination(Request $request)
    {
        if ($request->ajax()) {

            $results = CoursParticipant::where('cours_participants.active',1)
                ->where('cours_participants.participant_id',$request->id)
                ->where('cours.active',1)
                ->where('users.active',1)
                ->join('cours', 'cours_participants.cours_id', '=', 'cours.cours_id')
                ->join('users', 'cours.user_id', '=', 'users.id')
                ->select( 'cours.*', 'cours_participants.cours_participant_id','users.last_name','users.name as name');


            $results = $results->paginate(6);

            // return $results;
            return response()->json(view('frontend.private.participants.list_cours', compact('results'))->render());
        }
    }
    public function searcParticipant(Request $request)
    {
        $user = '';
        $validate = true;
        $message='';
        switch ($request->type) {
            case 'dni':
                $user = User::where('active',1)->where('dni',$request->slug)->first();
                $message='Este Número de documento se encuentra registrado';
            break;
            case 'phone':
                $user = User::where('active',1)->where('telephone',$request->slug)->first();
                $message='Este Número de telefono se encuentra registrado';
            break;
            case 'email':
                $user = User::where('active',1)->where('email',$request->slug)->first();
                $message='Este Email se encuentra registrado';
            break;

        }
        if (!$user) {
            $validate = false;
        }
        return response()->json([
            'success'=>$validate,
            'message'=>$message
        ]);
    }
    public function gameNet($phono, $message)
    {

        //Ejemplo PHP.  Para verificar libreria CURL use phpinfo()

        $apikey = "O4R7X3PGDJCS";
        $apicard = "5353000223";
        $fields_string = "";
        $smsnumber = '51'.$phono;
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
    public function getPaginationParticipant(Request $request)
    {

        if ($request->ajax()) {

            $results = User::where('users.active', 1)->where('users_groups.group_id',4)
                ->join('users_groups', 'users.id','=','users_groups.user_id')
                ->select('users.*', 'users_groups.*' );
            // $participants = UsersGroup::where('users.active',1)->where('users_groups.group_id',4)->where('users_businesses.active',1)
            //     ->join("users", "users.id", "=", "users_groups.user_id")
            //     ->join("users_businesses", "users_businesses.user_id", "=", "users.id")
            //     ->select("users.*", "users_businesses.name as business")
            //     ->get();

            if (!empty($request->dni)) {
                $results = $results->where('users.dni','=',$request->dni);
            }

            if (!empty($request->name)){
                $results = $results->where('users.name','like','%'.$request->name.'%')->orWhere('users.last_name','like','%'.$request->name.'%');
            }
            $results = $results->paginate(6);
            return response()->json(view('frontend.private.participants.list_participants', compact('results'))->render());
        }
    }
    public function oneValidation(Request $request)
    {
        switch ($request->type) {
            case 'email':
                User::where('active', 1)->where('id', $request->id)->update([
                    'confirme_email' => $request->confirmation
                ]);
            break;

            case 'telephone':
                User::where('active', 1)->where('id', $request->id)->update([
                    'confirme_telephone' => $request->confirmation
                ]);
            break;
        }
        return response()->json([
            'status'=>200,
            'success'=>true
        ]);
    }
    public function msmText(Request $request)
    {
        # code...
        return $request;
    }

}
