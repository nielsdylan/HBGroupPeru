<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Business;
use App\Models\Cours;
use App\Models\User;
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
        $business = Business::where('active',1)->get();
        return view('frontend.private.courses.index', compact('results','business'));
    }
    public function create()
    {
        $teacher = User::where('active',1)->where('group_id',5)->get();
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
        // return date("Y-d-m", strtotime($request->date_start));
        $cours = new Cours();
        $cours->asignature_id   = $request->asignature;
        $cours->code            = $request->code;
        $cours->course          = $request->course;
        $cours->user_id         = $request->teacher;
        $cours->date_start      = date("Y-d-m", strtotime($request->date_start));
        $cours->hour_start      = $request->hour_start;
        $cours->hour_end        = $request->hour_end;
        $cours->business_id        = $request->bussiness_id;

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
        $teacher = User::where('active',1)->where('group_id',5)->get();
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
        Cours::where('active', 1)->where('cours_id', $curso->cours_id)
        ->update([
            'asignature_id' => $request->asignature,
            'code' => $request->code,
            'course' => $request->course,
            'user_id' => $request->teacher,
            'date_start' => date("Y-d-m", strtotime($request->date_start)),
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'business_id' => $request->bussiness_id,
            'update_by'=>session('hbgroup')['user_id']
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
            ->join('businesses', 'cours.business_id','=','businesses.business_id')
            ->join('users', 'cours.user_id','=','users.id')
            ->select('cours.*', 'asignatures.name as asignature_name', 'asignatures.abbreviation as abbreviation', 'businesses.name as business', 'users.name as user_name', 'users.last_name as user_lastname' )
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
}
