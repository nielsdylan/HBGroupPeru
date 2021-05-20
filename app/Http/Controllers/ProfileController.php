<?php

namespace App\Http\Controllers;

use App\Models\Document_type;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        # code...
        $document_types = Document_type::where('active', 1)
                            ->get();
        $user = User::where('id',session('hbgroup')['user_id'])
                ->join("groups", "groups.group_id", "=", "users.group_id")
                ->select("groups.name as group", "users.*")
                ->first();
        return view('frontend.private.profile.index', compact('user', 'document_types'));
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
        if ($request->image) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('assets/img/user');
            $request->image->move($destination, $name);
            $perfil->image = $name;
            session(['hbgroup.image'=>$name]);
        }

        $perfil->save();
        session(['hbgroup.name'=>$request->name]);
        session(['hbgroup.last_name'=>$request->last_name]);
        return redirect()->route('perfil.index');
    }
}
