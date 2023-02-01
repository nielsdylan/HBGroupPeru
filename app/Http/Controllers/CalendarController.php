<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Business;
use App\Models\Cours;
use App\Models\Event;
use App\Models\UsersGroup;
use App\Models\Vacancie;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index()
    {
        $asignature = Asignature::where('active',1)->where('status',1)->get();
        return view('frontend.private.calendar.index',compact('asignature'));
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
    public function edit($calendario)
    {
        $curso = Cours::where('active',1)->where('cours_id',$calendario)->first();
        $teacher = UsersGroup::where('users_groups.group_id',5)->where('users_groups.active',1)
            ->join("users", "users.id", "=", "users_groups.user_id")
            ->select("users.*")
            ->get();
        $asignature = Asignature::where('active',1)->where('status',1)->get();
        $business = Business::where('active', 1)->get();
        $vacancies = Vacancie::where('active',1)->where('cours_id',$curso->cours_id)->first();

        return response()->json([
            'success'=>true,
            'status'=>200,
            'cours'=>$curso,
            'vacancies'=>$vacancies,
            'asignature'=>$asignature
        ]);
    }
    public function update(Request $request, Cours $calendario)
    {
        // return $request;
        // Event::where('active', 1)->where('id', $request->id )
        // ->update([
        //     'asignature' => $request->asignature,
        //     'course' => $request->course,
        //     'hour_start' => $request->hour_start,
        //     'hour_end' => $request->hour_end,
        //     'date_start' => $request->date_hidden,
        //     'active' => $request->active==0 ? $request->active : 1,
        //     'update_by'=>session('hbgroup')['user_id']
        // ]);


        // $date = explode('/',$request->date_start);
        // $date = $date[2].'-'.$date[1].'-'.$date[0];
        // return $request;
        $date = date("Y-m-d", strtotime($request->date_hidden) );
        Cours::where('active', 1)->where('cours_id', $calendario->cours_id)
        ->update([
            'asignature_id' => $request->asignature,
            'code' => $request->code,
            'course' => $request->course,
            'user_id' => $request->teacher?$request->teacher:176,
            'date_start' => $date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'calendar' => 1,
            'update_by'=>session('hbgroup')['user_id'],
            'meeting_active' => 0,
            'max_vacancies'=>$request->max_vacancies>0 ?$request->max_vacancies:0,
            'active' => $request->active==null ? 1 : 0
        ]);
        $hoy = date('Y-m-d H:i:s');
        Vacancie::where('active', 1)->where('cours_id', $calendario->cours_id)
        ->update([
            'active'        => 0,
            'deleted_at'    => $hoy,
            'update_by'     => session('hbgroup')['user_id'],
            'delete_by'     => session('hbgroup')['user_id']
        ]);

        $vacancies = new Vacancie();
        $vacancies->number      = $request->vacancies;
        $vacancies->cours_id    = $calendario->cours_id;
        $vacancies->create_by    = session('hbgroup')['user_id'];
        $vacancies->update_by    = session('hbgroup')['user_id'];
        $vacancies->save();


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
