<?php

namespace App\Imports;

use App\Models\Cours;
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
                }


                $participan = new Participant();
                $participan->user_id = $user->id;
                $participan->create_by = session('hbgroup')['user_id'];
                $participan->save();

                $cours = Cours::where('active',1)->where('cours_id',session('participant')['cours_id'])->first();

                $cours_participant = new CoursParticipant();
                $cours_participant->business_id     = $cours->business_id;
                $cours_participant->asignature_id   = session('participant')['asignature_id'];
                $cours_participant->participant_id  = $participan->participant_id;
                $cours_participant->cours_id        = $cours->cours_id ;
                $cours_participant->create_by       = session('hbgroup')['user_id'];
                $cours_participant->save();

                // dd($participant);
                // dd($value[0]);
            }
        }

    }
}
