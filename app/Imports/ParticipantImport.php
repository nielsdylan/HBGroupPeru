<?php

namespace App\Imports;

use App\Models\Participant;
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
                $participant = new Participant();
                $participant->dni       = $value[0];
                $participant->last_name = $value[1];
                $participant->name      = $value[2];
                $participant->email     = $value[3];
                $participant->cell      = $value[4];
                $participant->sex       = $value[5];
                $participant->business  = $value[6];
                $participant->save();
                // dd($value[0]);
            }
        }

    }
}
