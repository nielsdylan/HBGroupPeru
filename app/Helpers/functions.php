<?php
    include('httpPHPAltiria.php');
    function sendText($data)
    {
        $altiriaSMS = new AltiriaSMS();

        $altiriaSMS->setLogin($data['setLogin']);
        $altiriaSMS->setPassword($data['setPassword']);

        $altiriaSMS->setDebug(true);

        //Use this ONLY with Sender allowed by altiria sales team
        //$altiriaSMS->setSenderId('TestAltiria');
        //Concatenate messages. If message length is more than 160 characters. It will consume as many credits as the number of messages needed
        //$altiriaSMS->setConcat(true);
        //Use unicode encoding (only value allowed). Can send ����� but message length reduced to 70 characters
        //$altiriaSMS->setEncoding('unicode');

        //$sDestination = '346xxxxxxxx';
        $sDestination = '51'.$data['destination'].'';
        //$sDestination = array('346xxxxxxxx','346yyyyyyyy');

        $response = $altiriaSMS->sendSMS($sDestination, $data['message']);

        if (!$response)
        {
            $response=false;
        }else{
            $mystring = $response;
            // $respon = json_encode($respon);
            $findme = 'response: OK';
            $pos = strpos($mystring, $findme);
        }


        return $pos;
    }
    function test()
    {
        $mystring = "Sat, 10 Jul 2021 17:37:23 +0000 : NO domainId</br>Sat, 10 Jul 2021 17:37:23 +0000 : NO senderId </br>Sat, 10 Jul 2021 17:37:23 +0000 : NO concat </br>Sat, 10 Jul 2021 17:37:23 +0000 : NO encoding</br>Sat, 10 Jul 2021 17:37:24 +0000 : Server Altiria response: OK dest:51952146299
        </br>";
        // $respon = json_encode($respon);
        $findme = 'response: OK';
        $pos = strpos($mystring, $findme);

        return $pos;
    }
    function credits(){
        $altiriaSMS = new AltiriaSMS();
        // $altiriaSMS->setUrl("http://www.altiria.net/api/http");

        $altiriaSMS->setDebug(true);
        $altiriaSMS->setLogin('info@hbgroup.pe');
        $altiriaSMS->setPassword('eb9ga5ty');

        $str = $altiriaSMS->getCredit();
        if (preg_match('/.*OK credit\(0\):(.*?)$/',$str,$match)==1) {
            # code...
            return "".$match[1]." créditos";
        }else{
            return " 0.00 créditos";
        }
    }
    function tokenTeams($refresh_token)
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
    function userHBGroup($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    function mailFolders($token,$user_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/'.$user_id.'/mailFolders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    function inboxOutlook($token, $user_id, $folder_id)
    {
        $urls = 'https://graph.microsoft.com/v1.0/users/'.$user_id.'/mailFolders/'.$folder_id.'/messages';
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/'.$user_id.'/mailFolders/'.$folder_id.'/messages',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    function messageAttachments($token,$user_id,$message_id)
    {
        $url = 'https://graph.microsoft.com/v1.0/users/'.$user_id.'/messages/'.$message_id.'/attachments';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/'.$user_id.'/messages/'.$message_id.'/attachments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
