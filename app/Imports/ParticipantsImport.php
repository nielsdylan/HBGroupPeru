<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participant([
            //
            'dni'       =>$row['dni'],
            'last_name' =>$row['last_name'],
            'name'      =>$row['name'],
            'email'     =>$row['email'],
            'cell'      =>$row['cell'],
            'sex'       =>$row['sex'],
            'business'  =>$row['business'],
        ]);
    }
}
