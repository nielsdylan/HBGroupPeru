<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\CoursParticipant;
use App\Models\Event;
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
    public function getCount(Request $request)
    {
        $participant = Participant::where('active',1)->where('user_id',$request->id)->first();
        $count_cours = CoursParticipant::where('active',1)->where('participant_id',$participant->participant_id)->count();
        return response()->json([
            'cours' => $count_cours,
            'passed'=> 0,
            'disapproved'=> 0,
            'status'  => 200,
        ]);
    }
    public function createMeetingTeams()
    {
        # code...
        $teams_success = true;
        $user = User::where('active',1)->where('id',session('hbgroup')['user_id'])->first();
        $organizer = Organizer::where('active',1)->where('email',$user->email)->first();
        $token_teams = $this->tokenTeams($organizer->refresh_token);
        // $token_teams = json_encode($token_teams);
        if ($token_teams !=true) {
            $teams_success =false;
            return $teams_success;
        }
        // $calendar = $this->calendarTeams($token_teams->access_token);
        return $token_teams;
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
    public function meetingTeams($token)
    {
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
        CURLOPT_POSTFIELDS =>'{
        "subject": "Primara reunion API 21",
        "body": {
            "contentType": "HTML",
            "content": "Does this time work for you?"
        },
        "start": {
            "dateTime": "2021-08-17T15:00:00",
            "timeZone": "Pacific Standard Time"
        },
        "end": {
            "dateTime": "2021-08-17T15:00:00",
            "timeZone": "Pacific Standard Time"
        },
        "location":{
            "displayName":"Cordova conference room ILO"
        },
        "attendees": [
            {
            "emailAddress": {
                "address":"info@hbgroup.pe",
                "name": "Niels"
            },
            "type": "required"
            }
        ],
        "organizer": {
                "emailAddress": {
                    "name": "Lourdes",
                    "address": "servicios@hbgroup.pe"
                }
            },
        "allowNewTimeProposals": true,
        "isOnlineMeeting": true,
        "onlineMeetingProvider": "teamsForBusiness"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-type: application/json',
            'Authorization: Bearer '.$token.''
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
