<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use DateTime;
use Illuminate\Http\Request;

class AsignatureController extends Controller
{
    //
    public function index()
    {
        $results = Asignature::where('active',1)->get();
        return view('frontend.private.asignatures.index', compact('results'));
    }
    public function store(Request $request)
    {
        $asignature = new Asignature();
        $asignature->name = $request->name;
        $asignature->abbreviation = $request->abbreviation;
        $asignature->status = $request->status;

        $asignature->create_by = session('hbgroup')['user_id'];
        $asignature->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Asignature $asignatura)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$asignatura
        ]);
    }
    public function update(Request $request, Asignature $asignatura)
    {
        // return $request;
        Asignature::where('active', 1)->where('asignature_id', $asignatura->asignature_id)
        ->update([
            'name' => $request->name,
            'status' => $request->status,
            'abbreviation' => $request->abbreviation,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(Asignature $asignatura)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Asignature::where('active', 1)->where('asignature_id', $asignatura->asignature_id)
        ->update([
            'active' => 0,
            'status' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function getAsignature()
    {
        $results = Asignature::where('active',1)->where('status',1)->get();
        if ($results) {
            return response()->json([
                'success'=>true,
                'status'=>200,
                'results'=>$results
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'status'=>404
            ]);
        }

    }
}
