<?php

namespace App\Http\Controllers;

use App\Models\Pensum;
use DateTime;
use Illuminate\Http\Request;

class PensumController extends Controller
{
    //
    public function index()
    {

        return view('frontend.private.programs.index', compact('results'));
    }
    public function store(Request $request)
    {
        $pensum = new Pensum();
        $pensum->description    = $request->description;
        $pensum->program_id     = $request->program_id;
        $pensum->create_by      = session('hbgroup')['user_id'];
        $pensum->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Pensum $pensum)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$pensum
        ]);
    }
    public function update(Request $request, Pensum $pensum)
    {

        Pensum::where('active', 1)->where('program_id', $request->id )
        ->update([
            'code' => $request->code,
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($pensum)
    {
        $results = Pensum::where('active',1)->where('program_id',$pensum)->get();
        return response()->json([
            'success' =>true,
            'status'  =>200,
            'results' =>$results
        ]);
    }
    public function destroy(Pensum $pensum)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Pensum::where('active', 1)->where('pensum_id', $pensum->pensum_id )
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
