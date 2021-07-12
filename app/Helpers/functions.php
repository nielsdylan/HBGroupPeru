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
