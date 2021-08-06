<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Event;
use App\Models\PensumAsignature;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getPensumAsignatureShow(Request $request)
    {
        $results = PensumAsignature::where('pensum_asignatures.active', 1)->where('pensum_asignatures.pensum_id', $request->pensum_id)->where('asignatures.active',1)
            ->join("asignatures", "asignatures.asignature_id", "=", "pensum_asignatures.asignature_id")
            ->select("pensum_asignatures.*", "asignatures.code as code", "asignatures.name as name")
            ->get();
        if (count($results)>0) {
            return response()->json([
                'success' =>true,
                'status'  =>200,
                'results' =>$results,
            ]);
        }else{
            return response()->json([
                'success' =>false,
                'status'  =>404
            ]);
        }

    }
    public function getEvents()
    {
        return $events =   Event::where('active',1)->get();
    }
    public function event(Event $event)
    {
        # code...
        return response()->json([
            'success'=>true,
            'status'=>200,
            'result'=>$event
        ]);
    }
    public function updateDate(Request $request)
    {
        # code...
        Event::where('active', 1)->where('id', $request->id )
        ->update([
            'date_start'=>$request->start,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success' =>true,
            'status'  =>200,
        ]);
    }
    public function getCoursParticipanPagination(Request $request)
    {

        if ($request->ajax()) {
            // return $request->date;
            $results = Cours::where('cours.active',1)->where('users.group_id',5)
                ->join('users', 'cours.user_id', '=', 'users.id')
                ->select('cours.*', 'users.name as teacher_name', 'users.last_name as teacher_lastname');

            if (!empty($request->asignature_id)) {
                $results = $results->where('asignature_id','=',$request->asignature_id);
            }
            if (!empty($request->date)){

                $date = date("Y-d-m", strtotime($request->date));

                $results = $results->where('date_start','=',$date);
            }
            if (!empty($request->name)){
                $results = $results->where('course','like','%'.$request->name.'%')->orWhere('code','like','%'.$request->name.'%');
            }
            // $results = $results->paginate(6);
            $results = $results->paginate(7);
            return response()->json(view('frontend.private.cours_participants.list', compact('results'))->render());
        }
    }
}
