<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\MeetingsAssistant;
use App\Models\Organizer;
use App\Models\Participant;
use App\Models\PensumAsignature;
use App\Models\User;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

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

            $results = Cours::where('cours.active',1)
                ->join('users', 'cours.user_id', '=', 'users.id')
                ->select('cours.*', 'users.name as teacher_name', 'users.last_name as teacher_lastname');

            if (!empty($request->asignature_id)) {
                $results = $results->where('asignature_id','=',$request->asignature_id);
            }
            if (!empty($request->date)){
                $date = explode('/',$request->date);
                $date = $date[2].'-'.$date[1].'-'.$date[0];
                // $date = date("Y-d-m", strtotime($request->date));

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
    public function getCount(Request $request)
    {
        $participant = Participant::where('active',1)->where('user_id',$request->id)->first();
        $count_cours = CoursParticipant::where('active',1)->where('user_id',$request->id)->count();
        return response()->json([
            'cours' => $count_cours,
            'passed'=> 0,
            'disapproved'=> 0,
            'status'  => 200,
        ]);
    }
    public function createMeetingTeams(Request $request)
    {
        # code...
        if (empty($request->attendee)) {
            return response()->json([
                'status'=>404,
                'title' => 'Informativo',
                'type' => 'warning',
                'message'=> 'Seleccione un asistente para la creacion de la reunion',
            ]);
        }
        $cours = Cours::where('active',1)->where('cours_id',$request->cours_id)->first();
        $organizer = Organizer::where('active',1)->where('organizer_id',$request->organizer)->first();
        $attendees_array =array();
        foreach ($request->attendee as $key => $value) {
            $attendee = User::where('active',1)->where('id',$value)->first();
            if ($organizer->email == $attendee->email) {
                return response()->json([
                    'status'=>500,
                    'title' => 'Informativo',
                    'type' => 'warning',
                    'message'=> 'El organizador no puede ser un asistente',
                ]);
            }else{
                array_push($attendees_array,
                    array(
                        "emailAddress"=> array(
                            "address"=>$attendee->email,
                            "name"=> $attendee->last_name.', '.$attendee->name
                        ),
                        "type"=> "required"
                    )
                );
            }
        }

        $token_teams = $this->tokenTeams($organizer->refresh_token);
        if (!$token_teams) {
            return response()->json([
                'status'=> 404,
                'title' => 'Error',
                'type' => 'error',
                'message'=> 'Ocurrio un error con el organizador, seleccione otro organizador',
            ]);
        }
        $token_teams = json_decode($token_teams);

        $json_create_meeting = array(

                "subject"=> $cours->code,
                "body"=>array(
                    "contentType"=> "HTML",
                    "content"=> $cours->course
                ),
                "start"=>array(
                    "dateTime"=> $cours->date_start.'T'.$cours->hour_start,
                    "timeZone"=> "Pacific Standard Time"
                ),
                "end"=> array(
                    "dateTime"=> $cours->date_start.'T'.$cours->hour_end,
                    "timeZone"=> "Pacific Standard Time"
                ),
                "location"=>array(
                    "displayName"=>"HB Group Perú S.R.L. conference en ILO"
                ),
                "attendees"=> $attendees_array,
                "allowNewTimeProposals"=> true,
                "isOnlineMeeting"=> true,
                "onlineMeetingProvider"=> "teamsForBusiness"

        );

        // configurar el guardado
        $json = json_encode($json_create_meeting);
        // return $json;
        $json_meeting_teams =  $this->meetingTeams($token_teams->access_token,$json);
        $join_meeting = json_decode($json_meeting_teams);
        Cours::where('active', 1)->where('cours_id', $request->cours_id)
        ->update([
            'meeting_active'    => 1,
            'join_meeting'      => $join_meeting->onlineMeeting->joinUrl,
            'update_by'=>session('hbgroup')['user_id']
        ]);
        $hoy = date('Y-m-d H:i:s');
        Meeting::where('cours_id', $request->cours_id)
        ->update([
            'active'        => 0,
            'deleted_at'    =>$hoy,
            'update_by'     =>session('hbgroup')['user_id'],
            'delete_by'     =>session('hbgroup')['user_id']
        ]);
        MeetingsAssistant::where('cours_id', $request->cours_id)
        ->update([
            'active'        => 0,
            'deleted_at'    =>$hoy,
            'update_by'     =>session('hbgroup')['user_id'],
            'delete_by'     =>session('hbgroup')['user_id']
        ]);
        $meeting = new Meeting();
        $meeting->organizer_id  = $request->organizer;
        $meeting->cours_id      = $request->cours_id;
        $meeting->json_meeting  = $json_meeting_teams;
        $meeting->join_meeting  = $join_meeting->onlineMeeting->joinUrl;
        $meeting->create_by     = session('hbgroup')['user_id'];
        $meeting->save();


        foreach ($request->attendee as $key => $value) {
            $attendee = User::where('active',1)->where('id',$value)->first();
            $meetings_assistants = new MeetingsAssistant();
            $meetings_assistants->user_id  = $attendee->id;
            $meetings_assistants->meeting_id      = $meeting->meeting_id ;
            $meetings_assistants->cours_id  = $request->cours_id;
            $meetings_assistants->create_by     = session('hbgroup')['user_id'];
            $meetings_assistants->save();
        }

        return response()->json([
            'status'=>200,
            'title' => ' ',
            'type' => 'success',
            'message'=> 'Se guardo con éxito',
        ]);
    }
    public function tokenTeams($refresh_token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'client_id=b57f99a3-d61e-4a74-a79e-aa91d4bc03d6&scope=user.read&client_secret=lxU8MHU5XJW_YTdj56uln_omjB_06c3.I_&grant_type=refresh_token&refresh_token='.$refresh_token.'&redirect_uri=https%3A%2F%2Fhbgroup.pe%2Ftoken',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: buid=0.AX0AFSpzYanp7UyxmM5mlR5hQaOZf7Ue1nRKp56qkdS8A9Z9AAA.AQABAAEAAAD--DLA3VO7QrddgJg7WevrubmlCuWp9TD2C1ChDRnWpr5j2nuKX9MfpfhBWqwfKinDauPn5rKYYyL8WxCf1aR090M48C690cz8OrCwn0jF-7nPpkmpcgm7cpMXJjTb8IAgAA; fpc=ArDA9pPZuqJKhADCdbCSXaEs2i1RAQAAAMmnrdgOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function meetingTeams($token,$json)
    {

        // $token = json_encode($token);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/me/events',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>''.$json,
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Authorization: Bearer '.$token.''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
