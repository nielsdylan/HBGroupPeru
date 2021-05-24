<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\SedeTurn;
use App\Models\Turn;
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
        $sedes = Sede::where('active',1)->get();
        $turns = Turn::where('active',1)->get();
        return view('frontend.private.sede_turn.index', compact('response','sedes','turns'));
    }
    public function store(Request $request)
    {
        $sede_turn = new SedeTurn();
        $sede_turn->sede_id = $request->sede;
        $sede_turn->turn_id = $request->turn;

        $sede_turn->create_by = session('hbgroup')['user_id'];
        $sede_turn->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);

    }
    public function edit(SedeTurn $sede_turno)
    {

        return response()->json([
            'success'=>true,
            'status'=>200,
            'sede_turn'=>$sede_turno
        ]);
    }
    public function update(Request $request, SedeTurn $sede_turno)
    {
        SedeTurn::where('active', 1)->where('sede_turn_id', $sede_turno->sede_turn_id)
        ->update([
            'sede_id' => $request->sede,
            'turn_id' => $request->turn,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(SedeTurn $sede_turno)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        SedeTurn::where('active', 1)->where('sede_turn_id', $sede_turno->sede_turn_id)
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
