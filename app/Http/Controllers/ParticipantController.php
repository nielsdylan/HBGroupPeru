<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Asignature;
use App\Models\Business;
use App\Models\CoursParticipant;
use App\Models\Participant;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    //
    public function index()
    {
        $participants = CoursParticipant::where('cours_participants.active',1)
            ->where('businesses.active',1)
            ->where('participants.active',1)
            ->join("businesses", "businesses.business_id", "=", "cours_participants.business_id")
            ->join("participants", "participants.participant_id", "=", "cours_participants.participant_id")
            ->select("businesses.name as name_business", "participants.*")
            ->get();
        $asignatures =  Asignature::where('active',1)->get();
        $business = Business::where('active',1)->get();
        return view('frontend.private.participants.index', compact('participants', 'asignatures', 'business'));
    }
    public function store(Request $request)
    {
        $json = array(
            'business_id'=>$request->business,
            'asignature_id'=>$request->asignature,
        );
        // return $request;
        $request->session()->put('participant',$json);
        $file = $request->file('file');
        Excel::import(new ParticipantImport, $file);



        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Participant $sede)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'sede'=>$sede
        ]);
    }
    public function update(Request $request, Participant $sede)
    {
        Participant::where('active', 1)->where('sede_id', $sede->sede_id)
        ->update([
            'name' => $request->name,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(Participant $sede)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Participant::where('active', 1)->where('sede_id', $sede->sede_id)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
