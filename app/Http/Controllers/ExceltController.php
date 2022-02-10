<?php

namespace App\Http\Controllers;

use App\Exports\CertificadoExport;
use App\Exports\ModelExport;
use App\Exports\ParticipantsExport;
use App\Exports\ValidationExport;
use App\Imports\ParticipantImport;
use App\Imports\ParticipantsImport;
use Illuminate\Http\Request;
use App\Imports\ServiciosImport;
use Maatwebsite\Excel\Facades\Excel;

class ExceltController extends Controller
{
    //
    public function saveParticipant(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ParticipantImport, $file);

        // $status = 401;
        // if ($request) {
        //     $status = 200;
        // }
        // return response()->json(['status'=>$status]);
    }
    public function exportParticipant()
    {
        return Excel::download(new ParticipantsExport, 'Lista-Participantes.xlsx');
    }
    public function modelExel()
    {
        return Excel::download(new ModelExport, 'Modelo-excel.xlsx');
    }
    public function certificadoModelExel()
    {
        return Excel::download(new CertificadoExport, 'Certificado-Modelo-Excel.xlsx');
    }
    public function exportParticipantValidados()
    {
        return Excel::download(new ValidationExport, 'Lista-Participantes-Validation.xlsx');
    }
}
