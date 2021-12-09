<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Business;
use App\Models\Cours;
use App\Models\Organizer;
use App\Models\User;
use App\Models\UsersGroup;
use DateTime;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    //
    public function index()
    {
        $results = Cours::where('cours.active',1)->where('asignatures.active',1)
            ->orderByDesc('cours.cours_id')
            ->join("asignatures", "asignatures.asignature_id", "=", "cours.asignature_id")
            ->select("cours.*", "asignatures.name as asignature_name", "asignatures.code as asignature_code")
            ->get();
        $asignatures = Asignature::where('active',1)->get();
        $business = Business::where('active',1)->get();
        return view('frontend.private.courses.index', compact('results','business','asignatures'));
    }
    public function create()
    {
        // $teacher = User::where('active',1)->where('group_id',5)->get();
        $teacher = UsersGroup::where('users_groups.group_id',5)->where('users_groups.active',1)
            ->join("users", "users.id", "=", "users_groups.user_id")
            ->select("users.*")
            ->get();
        $asignature = Asignature::where('active',1)->where('status',1)->get();
        $business = Business::where('active', 1)->get();
        return view(
            'frontend.private.courses.create',
            compact(
                'asignature',
                'business',
                'teacher'
            )
        );
    }
    public function store(Request $request)
    {
        # code...
        $date = explode('/',$request->date_start);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $cours = new Cours();
        $cours->asignature_id   = $request->asignature;
        $cours->code            = $request->code;
        $cours->course          = $request->course;
        $cours->user_id         = $request->teacher;
        $cours->date_start      = $date;
        $cours->hour_start      = $request->hour_start;
        $cours->hour_end        = $request->hour_end;
        // $cours->business_id        = $request->bussiness_id;

        $cours->create_by = session('hbgroup')['user_id'];
        $cours->save();
        return response()->json([
            'success'=>true,
            'status'=>200,
            'results'=>$cours
        ]);
    }
    public function getCourses()
    {

        $results = Cours::where('cours.active',1)->where('asignatures.active',1)
            ->orderByDesc('cours.cours_id')
            ->join("asignatures", "asignatures.asignature_id", "=", "cours.asignature_id")
            ->select("cours.*", "asignatures.name as asignature_name", "asignatures.code as asignature_code")
            ->get();
        // $links  = $results->links();
        if (count($results)>0) {
            return response()->json([
                'success'=>true,
                'status'=>200,
                'results'=>$results,
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404
            ]);
        }
    }
    public function edit(Cours $curso)
    {
        $teacher = UsersGroup::where('users_groups.group_id',5)->where('users_groups.active',1)
            ->join("users", "users.id", "=", "users_groups.user_id")
            ->select("users.*")
            ->get();
        $asignature = Asignature::where('active',1)->where('status',1)->get();
        $business = Business::where('active', 1)->get();

        return view(
            'frontend.private.courses.edit',
            compact(
                'curso',
                'asignature',
                'business',
                'teacher'
            )
        );
    }
    public function update(Request $request, Cours $curso)
    {
        // return $request->id;
        $date = explode('/',$request->date_start);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        Cours::where('active', 1)->where('cours_id', $curso->cours_id)
        ->update([
            'asignature_id' => $request->asignature,
            'code' => $request->code,
            'course' => $request->course,
            'user_id' => $request->teacher,
            'date_start' => $date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'update_by'=>session('hbgroup')['user_id'],
            'meeting_active' => 0,
        ]);

        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(Cours $curso)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        $hoy = date('Y-m-d H:i:s');
        // return $hoy;
        Cours::where('active', 1)->where('cours_id', $curso->cours_id)
        ->update([
            'active' => 0,
            'deleted_at'=>$hoy,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($curso)
    {
        # code...
        $curso = Cours::where('cours.active', 1)->where('cours.cours_id', $curso)->where('asignatures.active', 1)
            ->join('asignatures', 'cours.asignature_id','=','asignatures.asignature_id')
            ->join('users', 'cours.user_id','=','users.id')
            ->select('cours.*', 'asignatures.name as asignature_name', 'asignatures.abbreviation as abbreviation', 'users.name as user_name', 'users.last_name as user_lastname' )
            ->first();
        // return $curso;
        return view(
            'frontend.private.courses.show',
            compact(
                'curso'
            )
        );
    }
    public function getCoursesAsignature(Request $request)
    {

        $cours = Cours::where('active',1)->where('asignature_id',$request->id)->get();
        if ($cours) {
            return response()->json([
                'success'=>true,
                'status'=>200,
                'results'=>$cours
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
            ]);
        }
    }
    public function getCodeCours($code)
    {
        $cours = Cours::where('active',1)->where('code',$code)->first();
        if ($cours) {
            return response()->json([
                'success'=>true,
                'status'=>200,
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
            ]);
        }
    }
    public function getCodeCoursID(Request $request)
    {
        # code...
        // return $request;
        $cours = Cours::where('active',1)->where('code',$request->code)->whereNotIn('cours_id', [$request->id])->first();
        if ($cours) {
            return response()->json([
                'success'=>true,
                'status'=>200,
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404,
            ]);
        }
    }
    public function getPagination(Request $request)
    {

        if ($request->ajax()) {

            $results = Cours::where('cours.active',1)->where('asignatures.active',1)
                ->orderByDesc('cours.cours_id')
                ->join("asignatures", "asignatures.asignature_id", "=", "cours.asignature_id")
                ->select("cours.*", "asignatures.name as asignature_name", "asignatures.code as asignature_code");

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
            $organizer = Organizer::where('active',1)->get();
            $attendee = User::where('active',1)->where('email','like','%@hbgroup.pe%')->get();
            return response()->json(view('frontend.private.courses.list_cours', compact('results','organizer','attendee'))->render());
        }
    }
}
