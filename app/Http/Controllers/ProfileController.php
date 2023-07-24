<?php

namespace App\Http\Controllers;

use App\Models\Document_type;
use App\Models\Instructor;
use App\Models\User;
use App\Models\UsersGroup;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        # code...
        // $instructor = Instructor::where('active',1)->where('user_id',session('hbgroup')['user_id'])->first();
        // $document_types = Document_type::where('active', 1)->get();
        // $profile = User::where('active',1)->where('id',session('hbgroup')['user_id'])->first();
        // $user = UsersGroup::where('users_groups.active',1)->where('users_groups.user_id',session('hbgroup')['user_id'])
        // ->join("users", "users.id", "=", "users_groups.user_id")
        // ->join("groups", "groups.group_id", "=", "users_groups.group_id")
        // ->select("groups.name as group", "groups.group_id", "users.*")
        // ->first();
        // $credits = credits();
        // return $user;
        return view('frontend.private.profile.index');
    }
    public function update(Request $request, User $perfil)
    {
        $perfil->dni        = $request->dni;
        $perfil->date_birth = $request->birth;
        $perfil->last_name  = $request->last_name;
        $perfil->name       = $request->name;
        $perfil->telephone  = $request->telephone;
        $perfil->whatsapp   = $request->whatsapp;
        $perfil->sexo       = $request->sexo;
        $perfil->document_type_id   = $request->document_type_id;
        if ($request->image) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination = 'assets/img/user';
            $request->image->move($destination, $name);
            $perfil->image = $name;
            session(['hbgroup.image'=>$name]);
        }

        $perfil->save();
        if (session('hbgroup')['group_id'] == 5) {
            $instructor = Instructor::where('active',1)->where('user_id',session('hbgroup')['user_id'])->first();

            $img_firm = $request->file('img_firm');
            $name_firm = time().'.'.$img_firm->getClientOriginalExtension();
            $firm_destinatario = 'assets/img/user';
            $img_firm->move($firm_destinatario, $name_firm);

            if ($instructor) {
                $hoy = date('Y-m-d H:i:s');
                Instructor::where('active', 1)->where('user_id', session('hbgroup')['user_id'])
                ->update([
                    'img_firm' => $name_firm,
                    'cip' => $request->cip,
                    'description' => $request->description,
                    'deleted_at'=>$hoy,
                    'update_by'=>session('hbgroup')['user_id']
                ]);
            }else{
                $instructor = new Instructor();
                $instructor->img_firm       = $name_firm;
                $instructor->cip            = $request->cip;
                $instructor->description    = $request->description;
                $instructor->user_id        = session('hbgroup')['user_id'];
                $instructor->create_by      = session('hbgroup')['user_id'];
                $instructor->save();
            }



        }
        session(['hbgroup.name'=>$request->name]);
        session(['hbgroup.last_name'=>$request->last_name]);
        return redirect()->route('perfil.index');
    }
}
