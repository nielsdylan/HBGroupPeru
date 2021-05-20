<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    // public function login()
    // {
    //     # code...
    //     return view('backend.login');
    // }
    public function loginHbgroup()
    {
        # code...
        return view('backend.login');
    }
    public function session(Request $request)
    {
        // $data = $request->input();
        // $request->session()->put('user', $data['username']);

        $user = User::where('email', $request->username)
                ->where('password', sha1($request->password))
                ->where('group_id', 1)
                ->first();
        if ($user) {
            $json_user = array(
                'user_id'=>$user->id,
                'email'=>$user->email,
            );
            $request->session()->put('user',$json_user);
            return response()->json([
                'success'=>true,
                'status'=>200
            ]);
        }else{
           return response()->json([
                'success'=>false,
                'status'=>400
            ]);
        }

    }
    public function logout()
    {
        if (session()->has('user')) {
            session()->pull('user');
            return redirect('hbgroupp_web');
        }
        if (session()->has('hbgroup')) {
            session()->pull('hbgroup');
            return redirect('login');
        }
    }
    public function login()
    {
        return view('frontend.login');
    }
    public function sessionStart(Request $request)
    {
        // $user = User::where('email', $request->username)
        //         ->where('password', sha1($request->password))
        //         ->first();
                $user = User::where('email', $request->username)
                ->where('password', sha1($request->password))
                ->join("groups", "groups.group_id", "=", "users.group_id")
                ->select("groups.name as group", "users.*")
                ->first();
        if ($user) {
            $json_user = array(
                'user_id'=>$user->id,
                'email'=>$user->email,
                'group_id'=>$user->group_id,
                'group'=>$user->group,
                'name'=>$user->name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
            );
            $request->session()->put('hbgroup',$json_user);
            return response()->json([
                'success'=>true,
                'status'=>200,
                'user'=>$user
            ]);
        }else{
           return response()->json([
                'success'=>false,
                'status'=>400
            ]);
        }
    }
}
