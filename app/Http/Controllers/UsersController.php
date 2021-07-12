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
    public function search(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $status = 404;
        if ($user) {
            $status = 200;
        }
        return response()->json([
            'status'=> $status
        ]);
    }
    public function getUser($slug)
    {
        $slug = explode('-',$slug);
        $success=false;
        $status=404;
        $user='';
        $array = array();
        switch ($slug[1]) {
            case 'dni':
                $user = $this->APIReniec($slug[0],$slug[1]);
                $user = json_decode($user);
                if ($user) {
                    $success=true;
                    $status=200;
                }

                $array['dni'] = $user->{'dni'};
                $array['last_name'] =$user->{'apellidoPaterno'}.' '.$user->{'apellidoMaterno'};
                $array['name'] =$user->{'nombres'};
                $array['document_type_id'] =2;
                $user = (object) $array;
            break;
            case 'ruc':
                $user = $this->APIReniec($slug[0],$slug[1]);
                $user = json_decode($user);
                if ($user) {
                    $success=true;
                    $status=200;
                }
                $name = explode(' ',$user->{'razonSocial'});
                $array['dni'] = $user->{'ruc'};
                $array['last_name'] =$name[0].' '.$name[1];
                $array['name'] =$name[2].' '.$name[3];
                $array['document_type_id'] = 4;
                $user = (object) $array;
            break;

            case 'hbgroup':
                $user = User::where('dni',$slug)->where('active',1)->first();
                if ($user) {
                    $success=true;
                    $status=200;
                }
            break;
        }
        return response()->json([
            'success'   =>  $success,
            'status'    =>  $status,
            'results'   =>  $user
        ]);

    }
    public function APIReniec($number,$type)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dniruc.apisperu.com/api/v1/'.$type.'/'.$number.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5pZWxzX2R5bGFuQGhvdG1haWwuY29tIn0.CB9fKgeDRyw-zRfqV-C6tPZ-Pe0J3FXtdADpABTmYZk',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
