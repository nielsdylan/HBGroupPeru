<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\User;
use Illuminate\Http\Request;

class CoursParticipantController extends Controller
{
    //
    public function index()
    {
        # code...
        if (!empty($_GET['DNI']) ) {
            $user = User::where('dni',$_GET['DNI'])->where('active',1)->first();
            if ($user) {
                $asignatures = Asignature::where('active',1)->get();
                $results = Cours::where('active',1)->paginate(2);
                return view('frontend.private.cours_participants.index',compact('user','results','asignatures'));
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }

    }
    public function store(Request $request)
    {

        if (!empty($request->cours)) {
            foreach ($request->cours as $key => $value) {

                $cours = Cours::where('active',1)->where('cours_id',$value)->first();

                $cours_participant = new CoursParticipant();
                $cours_participant->asignature_id = $cours->asignature_id;
                $cours_participant->participant_id =$request->id;
                $cours_participant->cours_id =$value;
                $cours_participant->save();
            }

            return response()->json([
                'success'=>true,
                'status'=>200
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404
            ]);
        }
    }
}
