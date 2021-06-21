<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    //
    public function index()
    {
        return view('frontend.private.courses.index');
    }
    public function store(Request $request)
    {
        # code...
        $asignature = new Cours();
        $asignature->name = $request->name;
        $asignature->abbreviation = $request->abbreviation;
        $asignature->status = $request->status;

        $asignature->create_by = session('hbgroup')['user_id'];
        $asignature->save();
    }
    public function getCourses()
    {
        $results = Cours::where('active',1)->get();
        if (count($results)>0) {
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
