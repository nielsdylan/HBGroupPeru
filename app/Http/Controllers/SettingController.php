<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use DateTime;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function setting()
    {
        # code...
        $configurations = Configuration::where('active', 1)->first();
        // return $configurations;
        return view('backend.private.configuration.configuration', compact('configurations'));
    }
    public function save(Request $request)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Configuration::where('active', 1)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'update_by'=>session('user')['user_id'],
            'delete_by'=>session('user')['user_id']


        ]);

        $configuration = new Configuration();
        $configuration->title       = $request->title;
        $configuration->sender      = $request->sender;
        $configuration->email       = $request->email;
        $configuration->telephone   = $request->telephone;
        $configuration->whatsapp    = $request->whatsapp;
        $configuration->mobile      = $request->mobile;
        $configuration->direction   = $request->direction;
        $configuration->facebook    = $request->facebook;
        $configuration->linkedin    = $request->linkedin;
        $configuration->schedule    = $request->schedule;
        $configuration->create_by    = session('user')['user_id'];
        $configuration->save();
        return redirect()->route('setting');
    }
}
