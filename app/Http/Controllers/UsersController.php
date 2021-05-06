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
        $users =  User::where('active', 1)
                    ->orderByDesc('id')
                    ->get();
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
        $user = new User();
        $user->name = $request->name;
        $user->email  = $request->email ;
        $user->password = sha1($request->password);
        $user->group_id = $request->group_id;
        $user->document_type_id = $request->document_type_id;
        $user->dni = $request->dni;
        $user->last_name = $request->last_name;
        $user->save();

        return redirect()->route('list_user');

    }
    public function edit($user_id)
    {
        $user = User::where('id', $user_id)
                    ->where('active', 1)
                    ->first();
        $groups = Group::where('active', 1)
                    ->get();
        $document_types = Document_type::where('active', 1)
                            ->get();
        return view('backend.private.user.user_edit', compact('user','groups','document_types'));
    }
    public function upload(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email  = $request->email ;
        if ($request->password) {
            $user->password = sha1($request->password);
        }
        $user->group_id = $request->group_id;
        $user->document_type_id = $request->document_type_id;
        $user->dni = $request->dni;
        $user->last_name = $request->last_name;
        $user->save();

        return redirect()->route('list_user');
    }
    public function delete(Request $request)
    {
        $business = User::find($request->id);
        User::where('active', 1)->where('id', $request->id)
        ->update([
            'active' => 0,
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
