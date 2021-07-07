<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Asignature;
use App\Models\Business;
use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Document_type;
use App\Models\Participant;
use App\Models\User;
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
            ->join("users", "users.id", "=", "participants.user_id")
            ->select("businesses.name as name_business", "participants.*",'users.*')
            ->get();
        $asignatures =  Asignature::where('active',1)->get();
        $business = Business::where('active',1)->get();
        $cours = Cours::where('active',1)->get();
        $document_types = Document_type::where('active', 1)->get();
        return view('frontend.private.participants.index', compact('participants', 'asignatures', 'business','cours','document_types'));
    }
    public function store(Request $request)
    {
        $json = array(
            'asignature_id'=>$request->asignature,
            'cours_id'=>$request->course,
        );

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
    public function destroy(Participant $participante)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        $participant = Participant::where('active',1)->where('participant_id',$participante->participant_id)->first();

        Participant::where('active', 1)->where('participant_id', $participante->participant_id)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        User::where('active', 1)->where('id', $participante->user_id)
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
    public function add(Request $request)
    {
        # code...
        $user = User::where('active',1)->where('dni',$request->dni)->first();
        if (!$user) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = sha1($request->dni);
            $user->group_id = 4;
            $user->document_type_id = $request->document_type_id;
            $user->dni = $request->dni;
            $user->last_name = $request->last_name;
            $user->telephone = $request->cell;
            $user->create_by = session('hbgroup')['user_id'];
            $user->save();
        }


        $participan = new Participant();
        $participan->user_id = $user->id;
        $participan->create_by = session('hbgroup')['user_id'];
        $participan->save();

        $cours = Cours::where('active',1)->where('cours_id',$request->course)->first();

        $cours_participant = new CoursParticipant();
        $cours_participant->business_id     = $cours->business_id;
        $cours_participant->asignature_id   = $request->asignature;
        $cours_participant->participant_id  = $participan->participant_id;
        $cours_participant->cours_id        = $cours->cours_id ;
        $cours_participant->create_by       = session('hbgroup')['user_id'];
        $cours_participant->save();

        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
