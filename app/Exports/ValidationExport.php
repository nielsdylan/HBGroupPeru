<?php

namespace App\Exports;

use App\Models\User as ModelsUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ValidationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }
    public function view(): View
    {
        return view('frontend.private.export.participant_validation', [
            'results' => ModelsUser::select('dni','last_name','name','email','telephone','sexo','confirme_telephone','confirme_email')
                ->where('active',1)
                ->where('confirme_telephone',1)
                ->where('confirme_email',1)
                ->get()
        ]);
    }
}
