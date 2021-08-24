<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\CoursParticipant;
use App\Models\Participant;
use Illuminate\Http\Request;

class MyCoursController extends Controller
{
    //
    public function index()
    {
        $asignatures = Asignature::where('active',1)->get();
        return view('frontend.private.my_cours.index',compact('asignatures'));
    }
    // public function show()
    // {
    //     # code...
    // }
    public function getPagination(Request $request)
    {
        if ($request->ajax()) {
            $participant = Participant::where('active',1)->where('user_id',$request->id)->first();
            // $results = CoursParticipant::where('active',1)->where('participant_id',$participant->participant_id)->first();
            // return $request;
            $results = CoursParticipant::where('cours_participants.active',1)
                ->where('cours_participants.participant_id',$participant->participant_id)
                ->where('cours.active',1)
                ->where('users.active',1)
                ->join('cours', 'cours_participants.cours_id', '=', 'cours.cours_id')
                ->join('users', 'cours.user_id', '=', 'users.id')
                ->join("asignatures", "asignatures.asignature_id", "=", "cours.asignature_id")
                ->select( 'cours.*', 'cours_participants.cours_participant_id','users.last_name','users.name as name',"asignatures.name as asignature_name");

            if (!empty($request->asignature_id)) {
                $results = $results->where('cours.asignature_id','=',$request->asignature_id);
            }
            if (!empty($request->date)){
                $date = explode('/',$request->date);
                $date = $date[2].'-'.$date[1].'-'.$date[0];

                $results = $results->where('cours.date_start','=',$date);
            }
            if (!empty($request->name)){
                $results = $results->where('cours.course','like','%'.$request->name.'%')->orWhere('cours.code','like','%'.$request->name.'%');
            }

            $results = $results->paginate(6);
            return response()->json(view('frontend.private.my_cours.list_pagination', compact('results'))->render());
        }
    }
}
