<?php

namespace App\Http\Controllers;

use App\Models\Program;
use DateTime;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    //
    public function index()
    {
        $results = Program::where('active',1)->get();
        return view('frontend.private.programs.index', compact('results'));
    }
    public function store(Request $request)
    {
        $program = new Program();
        $program->code = $request->code;
        $program->name = $request->name;
        $program->abbreviation = $request->abbreviation;
        $program->status = 1;

        $program->create_by = session('hbgroup')['user_id'];
        $program->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Program $programa)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$programa
        ]);
    }
    public function update(Request $request, Program $programa)
    {

        Program::where('active', 1)->where('program_id', $request->id )
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
    public function show(Program $programa)
    {

        return view('frontend.private.programs.show', compact('programa'));
    }
    public function destroy(Program $programa)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Program::where('active', 1)->where('program_id', $programa->program_id )
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
}
