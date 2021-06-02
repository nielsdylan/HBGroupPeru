<?php

namespace App\Imports;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ServiciosImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $key => $value) {
            if ($key>2) {
                $flight = Participant::where('number', 'FR 900')->first();
               dd($value);
            }

        }
    }
}
