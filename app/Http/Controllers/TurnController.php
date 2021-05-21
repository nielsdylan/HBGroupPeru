<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use DateTime;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    //
    public function index()
    {
        $turns = Turn::where('active',1)->get();
        return view('frontend.private.turn.index', compact('turns'));
    }
    public function store(Request $request)
    {
        $turn = new Turn();
        $turn->name = $request->name;

        $turn->create_by = session('hbgroup')['user_id'];
        $turn->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);

    }
    public function edit(Turn $turno)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'turn'=>$turno
        ]);
    }
    public function update(Request $request, Turn $turno)
    {
        Turn::where('active', 1)->where('turn_id', $turno->turn_id)
        ->update([
            'name' => $request->name,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(Turn $turno)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Turn::where('active', 1)->where('turn_id', $turno->turn_id)
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
