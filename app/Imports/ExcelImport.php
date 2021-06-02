<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Participant([
            //
            "code"                  => $row[1],
            "dni"                   => $row[2],
            "last_name"             => $row[3],
            "name"                  => $row[4],
            "email"                 => $row[5],
            "cell"                  => $row[6],
            "sex"                   => $row[7],
            "nationality"           => $row[8],
            "contract"              => $row[9],
            "business"              => $row[10],
            "stall"                 => $row[11],
            "vehicle_type"          => $row[12],
            "scheduled_date"        => $row[13],
            "theoretical_course"    => $row[14],
            "practical_assessment"  => $row[15],
            "observations"          => $row[16],
            "create_by"             => session('hbgroup')['user_id'],
        ]);
    }
}
