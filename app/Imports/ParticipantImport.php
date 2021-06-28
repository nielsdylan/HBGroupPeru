<?php

namespace App\Imports;

use App\Models\CoursParticipant;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ParticipantImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //

        foreach ($collection as $key => $value) {

            if ($key!=0) {
                $participant = Participant::where('dni',$value[0])->first();
                if (!$participant) {
                    $participant = new Participant();
                    $participant->dni       = $value[0];
                    $participant->last_name = $value[1];
                    $participant->name      = $value[2];
                    $participant->email     = $value[3];
                    $participant->cell      = $value[4];
                    $participant->sex       = $value[5];
                    $participant->create_by   = session('hbgroup')['user_id'];
                    $participant->save();

                    $user = new User();
                    $user->dni       = $value[0];
                    $user->last_name = $value[1];
                    $user->name      = $value[2];
                    $user->email     = $value[3];
                    $user->telephone      = $value[4];
                    $user->password       = sha1($value[0]);
                    $user->group_id       = 4;
                    $user->create_by   = session('hbgroup')['user_id'];
                    $user->save();
                }


                $cours_participant = new CoursParticipant();
                $cours_participant->business_id  = session('participant')['business_id'];
                $cours_participant->asignature_id  = session('participant')['asignature_id'];
                $cours_participant->participant_id  = $participant->participant_id;
                $cours_participant->create_by  = session('hbgroup')['user_id'];
                $cours_participant->save();
                // dd($participant);
                // dd($value[0]);
            }
        }

    }
}
