<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index()
    {
        return view('frontend.private.calendar.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'asignature'=> 'required',
            'course'    => 'required',
            'hour_start'=> 'required',
            'hour_end'  => 'required',
        ]);
        $event = new Event();
        $event->asignature      = $request->asignature;
        $event->course          = $request->course;
        $event->hour_start      = $request->hour_start;
        $event->hour_end        = $request->hour_end;
        $event->date_start      = $request->date_hidden;

        $event->create_by      = session('hbgroup')['user_id'];

        $event->save();
        return response()->json([
            'success'=>true,
            'status'=>200,
        ]);
    }
    public function edit(Event $calendario)
    {
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$calendario
        ]);
    }
    public function update(Request $request, Event $client)
    {

        Event::where('active', 1)->where('client_id', $request->id )
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
        $results = Event::where('active',1)->where('program_id',$pensum)->get();
        return response()->json([
            'success' =>true,
            'status'  =>200,
            'results' =>$results,
        ]);
    }
    public function destroy(Event $pensum)
    {
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Event::where('active', 1)->where('pensum_id', $pensum->pensum_id )
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
}
