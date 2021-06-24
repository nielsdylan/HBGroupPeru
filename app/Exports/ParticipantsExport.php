<?php

namespace App\Exports;

use App\Models\Participant as ModelsParticipant;
use App\Participant;
// use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ParticipantsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
        // return ModelsParticipant::select('dni','last_name','name','email','cell','sex','business')
        //     ->where('active',1)
        //     ->get();
    // }
    public function view(): View
    {
        return view('frontend.private.export.participant', [
            'results' => ModelsParticipant::select('dni','last_name','name','email','cell','sex','business')
                ->where('active',1)
                ->get()
        ]);
    }
}
