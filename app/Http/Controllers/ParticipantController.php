<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //
    public function index()
    {
        $participants = Participant::where('active',1)->get();
        return view('frontend.private.participants.index', compact('participants'));
    }
    public function store(Request $request)
    {
        $sede = new Sede();
        $sede->name = $request->name;

        $sede->create_by = session('hbgroup')['user_id'];
        $sede->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Sede $sede)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'sede'=>$sede
        ]);
    }
    public function update(Request $request, Sede $sede)
    {
        Sede::where('active', 1)->where('sede_id', $sede->sede_id)
        ->update([
            'name' => $request->name,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function destroy(Sede $sede)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Sede::where('active', 1)->where('sede_id', $sede->sede_id)
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
