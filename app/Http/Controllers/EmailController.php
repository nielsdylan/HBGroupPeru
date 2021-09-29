<?php

namespace App\Http\Controllers;

use App\Models\Asignature;
use App\Models\Organizer;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //
    public function index()
    {
        return view('frontend.private.mail.components.index');
    }
    public function inboxOutlook()
    {
        $organizer = Organizer::where('active',1)->where('email',session('hbgroup')['email'])->first();
        $token_teams = tokenTeams($organizer->refresh_token);
        $token_teams = json_decode($token_teams);
        $users_hbgroup = userHBGroup($token_teams->access_token);
        $users_hbgroup = json_decode($users_hbgroup);
        $user_hbgroup = array();
        foreach ($users_hbgroup->value as $key => $value) {
            if (session('hbgroup')['email'] == $value->mail) {
                $user_hbgroup['id']=$value->id;
                $user_hbgroup['email']=$value->mail;
                $user_hbgroup['surname']=$value->surname;
            }
        }
        $mail_folders = mailFolders($token_teams->access_token,$user_hbgroup['id']);
        $mail_folders = json_decode($mail_folders);
        $folder =[];
        foreach ($mail_folders->value as $key => $value) {
            if ($value->displayName == "Bandeja de entrada") {
                $folder = $value;
            }
        }
        $inbox_outlook = inboxOutlook($token_teams->access_token,$user_hbgroup['id'],$folder->id);
        $results = json_decode($inbox_outlook);
        // return response()->json([
        //     'status'=>200,
        //     'response'=>$inbox_outlook
        // ]);
        return response()->json(view('frontend.private.mail.components.list_inbox', compact('results'))->render());
    }
    public function create()
    {

        $asignatures    = Asignature::where('active',1)->get();
        return view('frontend.private.mail.components.create', compact('asignatures'));
    }
    public function show($email)
    {


        // echo '<img src="data:image;base64,'.$contentBytes.'">';
        // return $attachmant->value;
        // return $img_array;
        return view('frontend.private.mail.components.show',compact('email'));
    }
    public function mailConten(Request $request)
    {

        $organizer = Organizer::where('active',1)->where('email',session('hbgroup')['email'])->first();
        $token_teams = tokenTeams($organizer->refresh_token);
        $token_teams = json_decode($token_teams);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/me/messages/'.$request->mail_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$token_teams->access_token
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $content = $response->body->content;
        $subject = $response->subject;
        $users_hbgroup = userHBGroup($token_teams->access_token);
        $users_hbgroup = json_decode($users_hbgroup);
        $user_id ='';
        foreach ($users_hbgroup->value as $key => $value) {
            if (session('hbgroup')['email'] == $value->mail) {
                $user_id=$value->id;
            }
        }
        $attachmant = messageAttachments($token_teams->access_token, $user_id, $request->mail_id);
        // $attachmant = json_encode($attachmant);
        $attachmant = json_decode($attachmant);
        $contentBytes ='';
        $img_array = array();
        foreach ($attachmant->value as $key => $value) {
            if ('image001.png@01D7A322.EA589B50' == $value->contentId) {
                $contentBytes=$value->contentBytes;
            }
            array_push($img_array,array(
                "content_id"=>$value->contentId,
                "img"=>"data:image;base64,".$value->contentBytes."",
            ));
        }

        return response()->json(view('frontend.private.mail.components.body', compact('content','img_array','subject'))->render());
    }
}
