<?php

namespace App\Imports;

use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Mail\ContactMailable;
use App\Models\Configuration;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\WithValidation;

class ParticipantImport implements ToModel
{
    /**
    */
    // public function rules(): array
    // {
    //     return [
    //         'celular' => 'required',
    //     ];
    // }
    public function model(array $row)
    {
        // $response = [
        //     'nombre'=>$row['nombre']
        // ];
        return $row;
    }
    // public function collection(Collection $collection)
    // {
    //     //
    //     $success=true;
    //     foreach ($collection as $key => $value) {
    //         if ($key!=0) {
    //             if ($value[0]=='' || $value[0]==null) {
    //                 $success=false;
    //             }
    //             if ($value[1]=='' || $value[1]==null) {
    //                 $success=false;
    //             }
    //             if ($value[2]=='' || $value[2]==null) {
    //                 $success=false;
    //             }
    //             if ($value[3]=='' || $value[3]==null) {
    //                 $success=false;
    //             }
    //             if ($value[4]=='' || $value[4]==null) {
    //                 $success=false;
    //             }

    //         }
    //     }

    //     if ($success==true) {
    //         foreach ($collection as $key => $value) {

    //             if ($key!=0) {
    //                 $user = User::where('active',1)->where('dni',$value[0])->first();
    //                 if (!$user) {
    //                     $user = new User();
    //                     $user->name             = $value[2];
    //                     $user->email            = $value[3];
    //                     $user->password         = sha1($value[0]);
    //                     $user->group_id         = 4;
    //                     $user->dni              = $value[0];
    //                     $user->last_name        = $value[1];
    //                     $user->telephone        = $value[4];
    //                     $user->create_by        = session('hbgroup')['user_id'];
    //                     $user->save();

    //                     User::where('active', 1)->where('id', $user->id)->update([
    //                         'code_telephone' => session('participant')['rand_telephone'].'T'.$user->id,
    //                         'code_email'=>session('participant')['rand_email'].'E'.$user->id,
    //                     ]);

    //                     if (session('participant')['send_email'] == 1) {
    //                         $message_email_1='El proposito de este mensaje es de confirmar su correo electronico, el mismo mensaje se le envio a su número telefonico con el mismo proposito.';
    //                         $message_email_2='Por favor confirmar ambos medios de comunicacion para poder ingresar al curso gracias por su comprención.';
    //                         $message_email_3='Saludos cordiales HB GROUP PERU S.R.L.';

    //                         $button_email = 'Click para verificar su correo electronico.';
    //                         $configurations = Configuration::where('active', 1)->first();
    //                         $data = array(
    //                             "name"=> $user->name,
    //                             "last_name"=> $user->last_name,
    //                             "email"=> $user->email,
    //                             "telephone"=> $user->telephone,
    //                             "message_1"=> $message_email_1,
    //                             "message_2"=> $message_email_2,
    //                             "message_3"=> $message_email_3,
    //                             "button"=>$button_email,
    //                             "email_from"=>$configurations->sender,
    //                             "view"=>"verification",
    //                             "subject"=>"Autenticación de su correo electronico",
    //                             "rand"=>session('participant')['rand_email'].'E'.$user->id

    //                         );
    //                         $mail = new ContactMailable($data);
    //                         Mail::to($data['email'])->send($mail);
    //                     }

    //                     if (session('participant')['send_telephone'] == 1) {

    //                         $data =array(
    //                             "message"=>"ingrese al link para verificar su nùmero telefonico=>".url('/autenticacion?code=').session('participant')['rand_telephone'].'T'.$user->id."",
    //                             "destination"=>$user->telephone,
    //                             "setLogin"=>"info@hbgroup.pe",
    //                             "setPassword"=>"eb9ga5ty"
    //                         );
    //                         // sendText($data);
    //                     }
    //                     User::where('active', 1)->where('id', $user->id)->update([
    //                         'send_email' => session('participant')['send_email'],
    //                         'send_telephone' => session('participant')['send_telephone']
    //                     ]);

    //                 }

    //                 $participan = new Participant();
    //                 $participan->user_id = $user->id;
    //                 $participan->create_by = session('hbgroup')['user_id'];
    //                 $participan->save();

    //                 $cours = Cours::where('active',1)->where('cours_id',session('participant')['cours_id'])->first();

    //                 $cours_participant = new CoursParticipant();
    //                 $cours_participant->business_id     = $cours->business_id;
    //                 $cours_participant->asignature_id   = session('participant')['asignature_id'];
    //                 $cours_participant->participant_id  = $participan->participant_id;
    //                 $cours_participant->cours_id        = $cours->cours_id ;
    //                 $cours_participant->create_by       = session('hbgroup')['user_id'];
    //                 $cours_participant->save();

    //                 // dd($participant);
    //                 // dd($value[0]);
    //             }
    //         }
    //     }else{
    //         session(['participant.response'=>$success]);
    //     }



    // }
}
