<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        # code...
        $users = User::all();
        // return response()->json($users);
        return view('backend.private.user.user_list', compact('users'));
    }
    public function userNew()
    {
        return view('backend.private.user.user_add');
    }
    public function userEdit()
    {
        return view('backend.private.user.user_edit');
    }
}
