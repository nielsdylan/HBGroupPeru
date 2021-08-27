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
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    //
    public function index()
    {
        // $participants = CoursParticipant::where('cours_participants.active',1)
        //     ->where('businesses.active',1)
        //     ->where('participants.active',1)
        //     ->where('users.group_id',4)
        //     ->join("businesses", "businesses.business_id", "=", "cours_participants.business_id")
        //     ->join("participants", "participants.participant_id", "=", "cours_participants.participant_id")
        //     ->join("users", "users.id", "=", "participants.user_id")
        //     ->select("businesses.name as name_business", "participants.*",'users.*',"cours_participants.cours_participant_id")
        //     ->orderByDesc('cours_participants.cours_participant_id')
        //     ->get();
        $participants = User::where('active',1)->where('group_id',4)->get();
        // return $participants;
        $asignatures    = Asignature::where('active',1)->get();
        $business       = Business::where('active',1)->get();
        $cours          = Cours::where('active',1)->get();
        $prefixes       = Prefixe::get();
        $document_types = Document_type::where('active', 1)->get();
        return view(
            'frontend.private.participants.index',
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

            }
        }
        $participant_exclude_array=array();
        if ($success==true) {
            foreach ($array[0] as $key => $value) {
                $exist_cours_participant = false;
                if ($key!=0) {
                    $user = User::where('active',1)->where('dni',$value[0])->first();
                    if (!$user) {

                        $user = new User();
                        $user->name             = $value[2];
                        $user->email            = $value[3];
                        $user->password         = sha1($value[0]);
                        $user->group_id         = 4;
                        $user->dni              = $value[0];
                        $user->last_name        = $value[1];
                        $user->telephone        = $value[4];
                        $user->create_by        = session('hbgroup')['user_id'];
                        $user->save();

                        User::where('active', 1)->where('id', $user->id)->update([
                            'code_telephone' => $rand_telephone.'T'.$user->id,
                            'code_email'=>$rand_email.'E'.$user->id,
                        ]);

                        if ($request->send_email == 1) {
                            $message_email_1='El proposito de este mensaje es de confirmar su correo electronico, el mismo mensaje se le envio a su número telefonico con el mismo proposito.';
                            $message_email_2='Por favor confirmar ambos medios de comunicacion para poder ingresar al curso gracias por su comprención.';
                            $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';

                            $button_email = 'Click para verificar su correo electronico.';
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
                                "subject"=>"Autenticación de su correo electronico",
                                "rand"=>$rand_email.'E'.$user->id

                            );
                            $mail = new ContactMailable($data);
                            Mail::to($data['email'])->send($mail);
                        }

                        if ($request->send_telephone == 1) {

                            $data =array(
                                "message"=>"ingrese al link para verificar su nùmero telefonico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."",
                                "destination"=>$user->telephone,
                                "setLogin"=>"info@hbgroup.pe",
                                "setPassword"=>"eb9ga5ty"
                            );
                            // sendText($data);
                        }
                        User::where('active', 1)->where('id', $user->id)->update([
                            'send_email' => $request->send_email== 1 ? $request->send_email : 0,
                            'send_telephone' => $request->send_telephone == 1 ? $request->send_telephone : 0
                        ]);

                        $participan = new Participant();
                        $participan->user_id = $user->id;
                        $participan->create_by = session('hbgroup')['user_id'];
                        $participan->save();

                    }else{
                        $participan = Participant::where('active',1)->where('user_id',$user->id)->first();
                        $search_cours_participant = CoursParticipant::where('active',1)->where('cours_id',$request->course)->where('participant_id',$participan->participant_id)->first();
                        if ($search_cours_participant) {
                            $exist_cours_participant = true;
                        }

                    }

                    if ($exist_cours_participant == true) {
                        array_push($participant_exclude_array,
                            array(
                                "dni"=>$value[0],
                                "last_name"=>$value[1],
                                "name"=>$value[2],
                            )
                        );
                    }else{
                        $cours = Cours::where('active',1)->where('cours_id',$request->course)->first();

                        $cours_participant = new CoursParticipant();
                        // $cours_participant->business_id     = $cours->business_id;
                        $cours_participant->asignature_id   = $request->asignature;
                        $cours_participant->participant_id  = $participan->participant_id;
                        $cours_participant->cours_id        = $cours->cours_id ;
                        $cours_participant->create_by       = session('hbgroup')['user_id'];
                        $cours_participant->save();
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
                'existen'=>$participant_exclude_array
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
        $participant = Participant::where('active',1)->where('user_id',$participante->id)->first();
        $participants = CoursParticipant::where('cours_participants.active',1)
            ->where('cours_participants.participant_id',$participant->participant_id)
            ->where('participants.active',1)
            ->join("participants", "participants.participant_id", "=", "cours_participants.participant_id")
            ->join("users", "users.id", "=", "participants.user_id")
            ->join("asignatures", "asignatures.asignature_id", "=", "cours_participants.asignature_id")
            ->join("cours", "cours.cours_id", "=", "cours_participants.cours_id")
            ->select("participants.participant_id","users.*","asignatures.asignature_id","cours.*","cours_participants.cours_participant_id")
            ->first();
        $cours = Cours::where('active',1)->where('asignature_id',$participants->asignature_id)->get();
        $document_types = Document_type::where('active', 1)->get();
        $prefixes       = Prefixe::get();
        return view(
            'frontend.private.participants.edit',
            compact(
                'participante',
                'participants',
                'participant',
                'cours',
                'document_types',
                'prefixes',
            )
        );
    }
    public function update(Request $request, Participant $participante)
    {

        // CoursParticipant::where('active', 1)->where('cours_participant_id', $participante->cours_participant_id)
        // ->update([
        //     'asignature_id' => $request->asignature,
        //     'cours_id' => $request->course,
        //     'update_by'=>session('hbgroup')['user_id']
        // ]);

        $participant = Participant::where('active',1)->where('participant_id',$participante->participant_id)->first();

        $user = User::where('active',1)->where('id',$participant->user_id)->first();

        $message_email_1='El proposito de este mensaje es de confirmar su correo electronico, el mismo mensaje se le envio a su número telefonico con el mismo proposito.';
        $message_email_2='Por favor confirmar ambos medios de comunicacion para poder ingresar al curso gracias por su comprención.';
        $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';

        $button_email = 'Click para verificar su correo electronico.';
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
                "subject"=>"Autenticación de su correo electronico",
                "rand"=>$user->code_email

            );
            $this->sendEmail($data);

        }
        if ($user->send_telephone == 0 && $request->send_telephone == 1) {
            # code...
            $data =array(
                "message"=>"ingrese al link para verificar su nùmero telefonico=>".url('/autenticacion?code=').$user->code_telephone."",
                "destination"=>$request->cell,
                "setLogin"=>"info@hbgroup.pe",
                "setPassword"=>"eb9ga5ty"
            );
            $this->sendTelephone($data);

        }
        User::where('active', 1)->where('id', $participant->user_id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'document_type_id' => $request->document_type_id,
            'dni' => $request->dni,
            'last_name' => $request->last_name,
            'telephone' => $request->cell,
            'prefixe_id' => $request->prefixe_id,
            'send_email' => $request->send_email== 1 ? $request->send_email : 0,
            'send_telephone' => $request->send_telephone == 1 ? $request->send_telephone : 0,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($participante)
    {
        $participante = User::where('users.active', 1)
        ->where('users.id', $participante)
        ->where('participants.active', 1)
        ->where('document_types.active', 1)
        ->join('participants', 'users.id','=','participants.user_id')
        ->join('document_types', 'users.document_type_id','=','document_types.document_type_id')
        ->select('users.*', 'participants.participant_id', 'document_types.name as document')
        ->first();

        // return $participante;
        return view(
            'frontend.private.participants.show',
            compact(
                'participante'
            )
        );
    }
    public function destroy(User $participante)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        $participant = Participant::where('active',1)->where('user_id',$participante->id)->first();

        Participant::where('active', 1)->where('participant_id', $participant->participant_id)->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        User::where('active', 1)->where('id', $participant->user_id)
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
        $user = User::where('active',1)->where('dni',$request->dni)->where('group_id',4)->first();
        $text='';
        $message_email_1='El proposito de este mensaje es de confirmar su correo electronico, el mismo mensaje se le envio a su número telefonico con el mismo proposito.';
        $message_email_2='Por favor confirmar ambos medios de comunicacion para poder ingresar al curso gracias por su comprención.';
        $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';

        $button_email = 'Click para verificar su correo electronico.';
        $configurations = Configuration::where('active', 1)->first();
        if (!$user) {
            $user = new User();
            $user->name             = $request->name;
            $user->email            = $request->email;
            $user->password         = sha1($request->dni);
            $user->group_id         = 4;
            $user->document_type_id = $request->document_type_id;
            $user->dni              = $request->dni;
            $user->last_name        = $request->last_name;
            $user->prefixe_id       = $request->prefixe_id;
            $user->telephone        = $request->cell;

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
                    "subject"=>"Autenticación de su correo electronico",
                    "rand"=>$rand_email.'E'.$user->id

                );
                $this->sendEmail($data);
            }

            if ($request->send_telephone == 1) {

                $data =array(
                    "message"=>"ingrese al link para verificar su nùmero telefonico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."",
                    "destination"=>$request->cell,
                    "setLogin"=>"info@hbgroup.pe",
                    "setPassword"=>"eb9ga5ty"
                );
                $text= $this->sendTelephone($data);
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
                    "subject"=>"Autenticación de su correo electronico",
                    "rand"=>$rand_email.'E'.$user->id

                );
                $this->sendEmail($data);
                User::where('active', 1)->where('id', $user->id)->update([
                    'send_email' => $request->send_email,
                ]);
            }
            if ($user->send_telephone == 0 && $request->send_telephone == 1) {
                # code...
                $data =array(
                    "message"=>"ingrese al link para verificar su nùmero telefonico=>".url('/autenticacion?code=').$rand_telephone.'T'.$user->id."",
                    "destination"=>$user->telephone,
                    "setLogin"=>"info@hbgroup.pe",
                    "setPassword"=>"eb9ga5ty"
                );
                $text= $this->sendTelephone($data);
                User::where('active', 1)->where('id', $user->id)->update([
                    'send_telephone' => $request->send_telephone,
                ]);
            }
        }

        $rand_telephone = $rand_telephone.'T'.$user->id;
        $rand_email = $rand_email.'E'.$user->id;
        User::where('active', 1)->where('id', $user->id)->update([
            'code_telephone' => $rand_telephone,
            'code_email'=>$rand_email,
        ]);

        $participan = new Participant();
        $participan->user_id = $user->id;
        $participan->create_by = session('hbgroup')['user_id'];
        $participan->save();


        // foreach ($request->cours as $key => $value) {
        //     $cours = Cours::where('active',1)->where('cours_id',$value)->first();

        //     $cours_participant = new CoursParticipant();
        //     $cours_participant->business_id     = $cours->business_id;
        //     $cours_participant->asignature_id   = $request->asignature;
        //     $cours_participant->participant_id  = $participan->participant_id;
        //     $cours_participant->cours_id        = $cours->cours_id ;
        //     $cours_participant->create_by       = session('hbgroup')['user_id'];
        //     $cours_participant->save();
        // }


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
            return response()->json(view('frontend.private.participants.list_cours', compact('results'))->render());
        }
    }
}
