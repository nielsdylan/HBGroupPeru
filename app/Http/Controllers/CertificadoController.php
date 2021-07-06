<?php

namespace App\Http\Controllers;

use App\Imports\CertificadoImport;
use App\Models\Certificado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CertificadoController extends Controller
{
    //
    public function index()
    {
        $results = Certificado::where('certificados.active',1)
            ->where('participants.active',1)
            // ->where('participants.active',1)
            ->join("participants", "participants.participant_id", "=", "certificados.participant_id")
            // ->join("participants", "participants.participant_id", "=", "cours_participants.participant_id")
            ->select("participants.*", "certificados.description_cours", "certificados.date", "certificados.certificado_id")
            ->get();
        // return $results;
        return view('frontend.private.certificados.index', compact('results'));
    }
    public function store(Request $request)
    {
        // $json = array(
        //     'business_id'=>$request->business,
        //     'asignature_id'=>$request->asignature,
        // );
        // return $request;
        // $request->session()->put('participant',$json);
        $file = $request->file('file');
        Excel::import(new CertificadoImport, $file);



        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function destroy(Certificado $certificado)
    {
        Certificado::where('active', 1)->where('certificado_id', $certificado->certificado_id)
        ->update([
            'active' => 0,
            'deleted_at'=>date('Y-m-d H:i:s'),
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
