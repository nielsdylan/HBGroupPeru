<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ServiciosImport;
use Maatwebsite\Excel\Facades\Excel;

class ExceltController extends Controller
{
    //
    public function saveParticipant(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ServiciosImport, $file);

        $status = 401;
        if ($request) {
            $status = 200;
        }
        return response()->json(['status'=>$status]);
    }
}
