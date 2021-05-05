<?php

namespace App\Http\Controllers;

use App\Models\Document_type;
use App\Models\Group;
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
        $groups = Group::where('active', 1)
                    ->get();
        $document_types = Document_type::all();
        return view('backend.private.user.user_add', compact('groups','document_types'));
    }
    public function userAdd(Request $request)
    {
        // $user = new User();
        // $use

    }
    public function userEdit()
    {
        return view('backend.private.user.user_edit');
    }
}
