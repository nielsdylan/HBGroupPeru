<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    //
    public function lista()
    {
        return view('frontend.private.academico.alumno.lista');
    }
    public function listar(Request $request)
    {
        return response()->json(true,200);
    }
}
