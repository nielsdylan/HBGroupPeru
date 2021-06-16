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
    public function update(Request $request, Event $calendario)
    {

        Event::where('active', 1)->where('id', $request->id )
        ->update([
            'asignature' => $request->asignature,
            'course' => $request->course,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'date_start' => $request->date_hidden,
            'active' => $request->active==0 ? $request->active : 1,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function show($calendario)
    {
        $response = Event::where('active',1)->where('id',$calendario)->first();
        return response()->json([
            'success' =>true,
            'status'  =>200,
            'results' =>$calendario,
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
