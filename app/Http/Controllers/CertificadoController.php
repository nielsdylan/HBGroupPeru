<?php

namespace App\Http\Controllers;

use App\Imports\CertificadoImport;
use App\Models\Asignature;
use App\Models\Business;
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
            ->join("users", "users.id", "=", "participants.user_id")
            ->select("participants.user_id", "certificados.description_cours", "certificados.date", "certificados.certificado_id", "users.*")
            ->get();
        // return $results;
        $asignatures =  Asignature::where('active',1)->get();
        $business = Business::where('active',1)->get();
        return view('frontend.private.certificados.index', compact('results','asignatures','business'));
    }
    public function store(Request $request)
    {
        $json = array(
            'cours_id'=>$request->course,
            'asignature_id'=>$request->asignature,
        );
        $request->session()->put('certificado',$json);
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
