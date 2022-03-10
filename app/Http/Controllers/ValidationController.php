<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    //
    public function index()
    {
        // $results = Asignature::where('active',1)->get();
        return view('frontend.private.validation.index');
    }

    public function getPagination(Request $request)
    {

        if ($request->ajax()) {

            $results = User::where('users.active', 1)->where('users_groups.group_id',4)
                ->join('users_groups', 'users.id','=','users_groups.user_id')
                ->select('users.*', 'users_groups.*' );
            // $user = User::where('users.active', 1)->where('users_groups.group_id',4)
            //     ->join('users_groups', 'users.id','=','users_groups.user_id')
            //     ->select('users.*', 'users_groups.*' )
            //     ->get();
            // return $user;
            if (!empty($request->confirme_telephone)) {
                $results = $results->where('users.confirme_telephone','=',$request->confirme_telephone);
            }
            if (!empty($request->confirme_email)) {
                $results = $results->where('users.confirme_email','=',$request->confirme_email);
            }
            if (!empty($request->dni)) {
                $results = $results->where('users.dni','=',$request->dni);
            }
            if (!empty($request->name)){
                $results = $results->where('users.name','like','%'.$request->name.'%')->orWhere('users.last_name','like','%'.$request->name.'%');
            }
            $results = $results->paginate(6);
            return response()->json(view('frontend.private.validation.list_validation', compact('results'))->render());
        }
    }
}
