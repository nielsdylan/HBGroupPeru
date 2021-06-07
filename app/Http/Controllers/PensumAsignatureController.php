<?php

namespace App\Http\Controllers;

use App\Models\Pensum_Asignature;
use App\Models\PensumAsignature;
use Illuminate\Http\Request;

class PensumAsignatureController extends Controller
{
    //
    public function store(Request $request)
    {
        $pensum_asignature = new PensumAsignature();
        $pensum_asignature->pensum_id       = $request->pensum_id;
        $pensum_asignature->asignature_id   = $request->asignature_id;
        $pensum_asignature->ciclo_id    = $request->ciclo_id;
        $pensum_asignature->credits     = $request->credits;
        $pensum_asignature->weekly_hour = $request->weekly_hour;
        $pensum_asignature->total_hour  = $request->total_hour;
        $pensum_asignature->create_by   = session('hbgroup')['user_id'];
        $pensum_asignature->save();
        return response()->json([
            'success' =>true,
            'status'  =>200,
        ]);
    }
}
