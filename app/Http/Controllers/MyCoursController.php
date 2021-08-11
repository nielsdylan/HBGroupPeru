<?php

namespace App\Http\Controllers;

use App\Models\CoursParticipant;
use App\Models\Participant;
use Illuminate\Http\Request;

class MyCoursController extends Controller
{
    //
    public function index()
    {
        return view('frontend.private.my_cours.index');
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
            $results = CoursParticipant::where('cours_participants.active',1)
                ->where('cours_participants.participant_id',$participant->participant_id)
                ->where('cours.active',1)
                ->where('users.active',1)
                ->join('cours', 'cours_participants.cours_id', '=', 'cours.cours_id')
                ->join('users', 'cours.user_id', '=', 'users.id')
                ->select( 'cours.*', 'cours_participants.cours_participant_id','users.last_name','users.name as name');


            $results = $results->paginate(6);
            return response()->json(view('frontend.private.my_cours.list_pagination', compact('results'))->render());
        }
    }
}
