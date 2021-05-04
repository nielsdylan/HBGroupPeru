<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
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
        Configuration::where('active', 1)->update(['active' => 0]);

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
        $configuration->save();
        return redirect()->route('setting');
    }
}
