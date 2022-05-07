<?php

namespace App\Http\Controllers;

use App\Models\Client;
use DateTime;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index()
    {
        $results = Client::where('active',1)->get();
        return view('frontend.private.clients.index', compact('results'));
    }
    public function store(Request $request)
    {
        $pensum = new Client();
        $pensum->business    = $request->business;
        $pensum->email     = $request->email;
        if ($request->cell) {
          $pensum->cell    = $request->cell;
        }
        if ($request->telephone) {
            $pensum->telephone     = $request->telephone;
        }
        if ($request->whatsapp) {
            $pensum->whatsapp    = $request->whatsapp;
        }

        if ($request->address!='') {
            $pensum->address     = $request->address;
        }
        $pensum->create_by      = session('hbgroup')['user_id'];
        $pensum->save();

        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Client $cliente)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$cliente
        ]);
    }
    public function update(Request $request, Client $client)
    {

        Client::where('active', 1)->where('client_id', $request->id )
        ->update([
            'business' => $request->business,
            'email' => $request->email,
            'cell' => $request->cell,
            'telephone' => $request->telephone,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($pensum)
    {
        $results = Client::where('active',1)->where('program_id',$pensum)->get();
        return response()->json([
            'success' =>true,
            'status'  =>200,
            'results' =>$results,
        ]);
    }
    public function destroy(Client $pensum)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Client::where('active', 1)->where('pensum_id', $pensum->pensum_id )
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }

    public function getClientsApi()
    {
        $client = Client::where('active',1)->get();
        return response()->json([
            'success'=>true,
            'status'=>200,
            'data'=>$client
        ]);
    }
}
