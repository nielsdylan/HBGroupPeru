<?php

namespace App\Http\Controllers;

use App\Models\SedeTurn;
use DateTime;
use Illuminate\Http\Request;

class SedeTurnController extends Controller
{
    //
    public function index()
    {
        // $response = SedeTurn::where('active',1)->get();
        $response = SedeTurn::where('sede_turns.active', 1)
                ->join("sedes", "sedes.sede_id", "=", "sede_turns.sede_id")
                ->join("turns", "turns.turn_id", "=", "sede_turns.turn_id")
                ->select("sedes.name as sede","turns.name as turn" , "sede_turns.*")
                ->get();
        return view('frontend.private.sede_turn.index', compact('response'));
    }
    public function store(Request $request)
    {
        $turn = new SedeTurn();
        $turn->name = $request->name;

        $turn->create_by = session('hbgroup')['user_id'];
        $turn->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);

    }
    public function edit(SedeTurn $turno)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'turn'=>$turno
        ]);
    }
    public function update(Request $request, SedeTurn $turno)
    {
        SedeTurn::where('active', 1)->where('turn_id', $turno->turn_id)
        ->update([
            'name' => $request->name,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(SedeTurn $turno)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        SedeTurn::where('active', 1)->where('turn_id', $turno->turn_id)
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
