<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Cours;
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
        return view('frontend.private.courses.index', compact('results'));
    }
    public function store(Request $request)
    {
        # code...
        $cours = new Cours();
        $cours->asignature_id   = $request->asignature;
        $cours->code            = $request->code;
        $cours->course          = $request->course;
        $cours->date_start      = $request->date_start;
        $cours->hour_start      = $request->hour_start;
        $cours->hour_end        = $request->hour_end;

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
        $asignature = Asignature::where('active',1)->where('status',1)->get();
        if ($curso) {
            return response()->json([
                'success'=>true,
                'status'=>200,
                'cours'=>$curso,
                'asignature'=>$asignature
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404
            ]);
        }

    }
    public function update(Request $request, Cours $curso)
    {
        // return $request->id;
        Cours::where('active', 1)->where('cours_id', $request->id)
        ->update([
            'asignature_id' => $request->asignature,
            'code' => $request->code,
            'course' => $request->course,
            'date_start' => $request->date_start,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
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
}
