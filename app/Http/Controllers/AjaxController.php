<?php

namespace App\Http\Controllers;

use App\Models\PensumAsignature;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getPensumAsignatureShow(Request $request)
    {
        $results = PensumAsignature::where('pensum_asignatures.active', 1)->where('pensum_asignatures.pensum_id', $request->pensum_id)->where('asignatures.active',1)
            ->join("asignatures", "asignatures.asignature_id", "=", "pensum_asignatures.asignature_id")
            ->select("pensum_asignatures.*", "asignatures.code as code", "asignatures.name as name")
            ->get();
        if (count($results)>0) {
            return response()->json([
                'success' =>true,
                'status'  =>200,
                'results' =>$results,
            ]);
        }else{
            return response()->json([
                'success' =>false,
                'status'  =>404
            ]);
        }

    }
}
