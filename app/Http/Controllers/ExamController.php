<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function index()
    {
        # code...
        $results = Exam::where('active',1)->get();
        return view('frontend.private.exam.index', compact('results'));
    }
    public function create()
    {
        # code...
        return view('frontend.private.exam.create');
    }
    public function store(Request $request)
    {
        # code...
        $exam = new Exam();
        $exam->name         = $request->name;
        $exam->description  = $request->description;
        $exam->evaluation   = $request->evaluation;
        $exam->create_by    = session('hbgroup')['user_id'];
        $exam->save();
        return redirect()->route('examen.index');
    }
    public function edit(Exam $examan)
    {
        # code...

        return view('frontend.private.exam.edit',compact('examan'));
    }
    public function update(Request $request, Exam $examan)
    {
        # code...
        $examan->name         = $request->name;
        $examan->description  = $request->description;
        $examan->evaluation   = $request->evaluation;
        $examan->update_by = session('hbgroup')['user_id'];
        $examan->save();
        return redirect()->route('examen.index');
    }
    public function show()
    {
        # code...
    }
    public function destroy($examen)
    {
        # code...
        $fecha = date('Y-m-d H:i:s');
        Exam::where('active', 1)->where('exam_id', $examen)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'update_by'=>session('hbgroup')['user_id'],
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
