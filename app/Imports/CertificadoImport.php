<?php

namespace App\Imports;

use App\Models\Certificado;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CertificadoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $key => $value) {

            if ($key!=0) {
                $fecha = 86400  * ($value[5]-25568);
                $participant = Participant::where('dni',$value[0])->first();
                if (!$participant) {
                    $participant = new Participant();
                    $participant->dni       = $value[0];
                    $participant->last_name = $value[1].' '.$value[2];
                    $participant->name      = $value[3];

                    $participant->create_by   = session('hbgroup')['user_id'];
                    $participant->save();

                    $user = new User();
                    $user->dni       = $value[0];
                    $user->last_name = $value[1].' '.$value[2];
                    $user->name      = $value[3];
                    $user->password       = sha1($value[0]);
                    $user->group_id       = 4;
                    $user->create_by   = session('hbgroup')['user_id'];
                    $user->save();
                }


                $certificado = new Certificado();
                $certificado->description_cours  = $value[4];
                $certificado->date  = date('Y-m-d', $fecha);
                $certificado->participant_id  = $participant->participant_id;
                $certificado->create_by  = session('hbgroup')['user_id'];
                $certificado->save();
                // dd($participant);
                // dd($value[0]);
            }
        }
    }
}
