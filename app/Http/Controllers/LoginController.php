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
    }
    public function login()
    {
        return view('frontend.login');
    }
}
