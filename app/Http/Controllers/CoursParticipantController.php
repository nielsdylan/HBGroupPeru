<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Participant;
use App\Models\User;
use App\Models\UsersGroup;
use Illuminate\Http\Request;

class CoursParticipantController extends Controller
{
    //
    public function index()
    {
        # code...
        if (!empty($_GET['DNI']) ) {
            // $user = User::where('dni',$_GET['DNI'])->where('active',1)->first();
            $user = UsersGroup::where('users.dni',$_GET['DNI'])->where('users.active',1)->where('users_groups.group_id',4)
                ->join('users', 'users_groups.user_id','=','users.id')
                ->select('users.*')
                ->first();
            // return $user;
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

        // $participant = Participant::where('user_id',$request->id)->first();
        // return $participant;

        if (!empty($request->cours)) {
            $existen = false;
            foreach ($request->cours as $key => $value) {
                $cours_exist = CoursParticipant::where('active',1)->where('cours_id',$value)->where('participant_id',$request->id)->first();
                if ($cours_exist) {
                    $existen = true;
                }

            }
            if ($existen === false) {
                foreach ($request->cours as $key => $value) {
                    $cours = Cours::where('active',1)->where('cours_id',$value)->first();

                    $cours_participant = new CoursParticipant();
                    $cours_participant->asignature_id = $cours->asignature_id;
                    $cours_participant->participant_id =$request->id;
                    $cours_participant->cours_id =$value;
                    $cours_participant->save();
                }

                return response()->json([
                    'status'=>200,
                    'placementFrom'=>'top',
                    'placementAlign'=>'center',
                    'state'=>'success',
                    'style'=>'withicon',
                    'message'=>'Se guardo con éxito',
                    'title'=>'Seleccion de cursos',
                    'icon'=>'fas fa-check',
                ]);
            }else{
                return response()->json([
                    'status'=>200,
                    'placementFrom'=>'top',
                    'placementAlign'=>'center',
                    'state'=>'warning',
                    'style'=>'withicon',
                    'message'=>'Asignese cursos que no ha llevado.',
                    'title'=>'Seleccion de cursos',
                    'icon'=>'fas fa-info',
                ]);
            }

        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
                'placementFrom'=>'top',
                'placementAlign'=>'center',
                'state'=>'warning',
                'style'=>'withicon',
                'message'=>'Seleccione almenos un curso.',
                'title'=>'Seleccion de cursos',
                'icon'=>'fas fa-info',
            ]);
        }
    }
    public function getCoursParticipantPagination(Request $request)
    {
        if ($request->ajax()) {
            // return $request->date;
            $results = CoursParticipant::where('cours_participants.active',1)
                ->where('cours.cours_id',$request->cours_id)
                ->where('cours.active',1)
                ->where('participants.active',1)
                ->join('cours', 'cours_participants.cours_id', '=', 'cours.cours_id')
                ->join('participants', 'cours_participants.participant_id', '=', 'participants.participant_id')
                ->join('users', 'participants.user_id', '=', 'users.id')
                ->select('participants.user_id', 'users.*', 'cours_participants.cours_participant_id');

            // if (!empty($request->asignature_id)) {
            //     $results = $results->where('asignature_id','=',$request->asignature_id);
            // }
            // if (!empty($request->date)){

            //     $date = date("Y-d-m", strtotime($request->date));

            //     $results = $results->where('date_start','=',$date);
            // }
            // if (!empty($request->name)){
            //     $results = $results->where('course','like','%'.$request->name.'%')->orWhere('code','like','%'.$request->name.'%');
            // }
            // $results = $results->paginate(6);
                $results = $results->paginate(5);
            // return response()->json([
            //     'success'=>$results,
            //     'status'=>200
            // ]);
            return response()->json(view('frontend.private.courses.list_participant_pagination', compact('results'))->render());
        }
        // return response()->json([
        //     'success'=>$request->cours_id,
        //     'status'=>200
        // ]);
    }
    public function deleteParticipantCours(Request $request)
    {
        $hoy = date('Y-m-d H:i:s');
        $response = CoursParticipant::where('active', 1)->where('cours_participant_id', $request->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$hoy,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>$response,
            'status'=>200
        ]);
    }
}
