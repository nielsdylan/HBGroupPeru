<?php
// Copyright (c) 2020, Altiria TIC SL
// All rights reserved.
// El uso de este c�digo de ejemplo es solamente para mostrar el uso de la pasarela de env�o de SMS de Altiria
// Para un uso personalizado del c�digo, es necesario consultar la API de especificaciones t�cnicas, donde tambi�n podr�s encontrar
// m�s ejemplos de programaci�n en otros lenguajes y otros protocolos (http, REST, web services)
// https://www.altiria.com/api-envio-sms/

class AltiriaSMS {

	protected $domainId;
	protected $login;
	protected $password;
	protected $senderId;
	protected $encoding;
	protected $concat;
	protected $timeout=60;
	protected $debug;

	protected $url = 'http://www.altiria.net/api/http';

	public function getDomainId() {
		return $this->domainId;
	}

	public function setDomainId($val) {
		$this->domainId = $val;
		return $this;
	}
	public function getLogin() {
		return $this->login;
	}

	public function setLogin($val) {
		$this->login = $val;
		return $this;
	}
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($val) {
		$this->password = $val;
		return $this;
	}
	public function getSenderId() {
		return $this->senderId;
	}

	public function setSenderId($val) {
		$this->senderId = $val;
		return $this;
	}
	public function getEncoding() {
		return $this->encoding;
	}

	public function setEncoding($val) {
		$this->encoding = $val;
		return $this;
	}
	public function getConcat() {
		return $this->concat;
	}

	public function setConcat($val) {
		$this->concat = $val;
		return $this;
	}

	public function getTimeout() {
		return $this->timeout;
	}

	public function setTimeout($val) {
		$this->timeout = $val;
		return $this;
	}

	public function getDebug() {
		return $this->debug;
	}

	public function setDebug($val) {
		$this->debug = $val;
		return $this;
	}

	public function sendSMS($destination, $message) {

		$return=false;

		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded; charset=UTF-8'));
		curl_setopt($ch, CURLOPT_HEADER, false);
		// Max timeout in seconds to complete http request
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->getTimeout());

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);


		 $COMANDO='cmd=sendsms&login='.$this->getLogin().'&passwd='.$this->getPassword();
		 $COMANDO.='&msg='.urlencode($message);

		//Como destinatarios se admite un array de tel�fonos, una cadena de tel�fonos separados por comas o un �nico tel�fono
		if (is_array($destination)){
		    foreach ($destination as $telefono) {
				$this->logMsg("Add destination ".$telefono);
				$COMANDO.='&dest='.$telefono;
		    }
		}
		else{
			if( strpos($destination, ',') !== false ){
				$destinationTmp= '&dest='.str_replace(',','&dest=',$destination).'&';
			    $COMANDO .=$destinationTmp;
				$this->logMsg("Add destination ".$destinationTmp);
			 }
			 else{
				$COMANDO.='&dest='.$destination;

			 }
		}
		//domainId solo es necesario si el login no es un email
		$domainId=$this->getDomainId();
		if (!isset($domainId) || empty($domainId)) {
			$this->logMsg("NO domainId");
		}
		else{
			$COMANDO.='&domainId='.$this->getDomainId();
			$this->logMsg("Add domainId ".$this->getDomainId());
		}

		//No es posible utilizar el remitente en Am�rica pero s� en Espa�a y Europa
		$senderId=$this->getSenderId();
		if (!isset($senderId) || empty($senderId)) {
			$this->logMsg("NO senderId ");
		}
		else{
			$COMANDO.='&senderId='.$senderId;
			$this->logMsg("Add senderId ".$senderId);
		}

		//Concat. Valores posibles true. Si no se especifica o es false, no se env�a
		$concat=$this->getConcat();
		if (!isset($concat) || empty($concat) || $concat===false) {
			$this->logMsg("NO concat ");
		}
		else{
			$COMANDO.='&concat=true';
			$this->logMsg("Add concat true");
		}

		//No es posible utilizar el remitente en Am�rica pero s� en Espa�a y Europa
		$encoding=$this->getEncoding();
		if (!isset($encoding) || empty($encoding)) {
			$this->logMsg("NO encoding");
		}
		else{
			if ($encoding==='unicode'){
				$COMANDO.='&encoding='.$encoding;
				$this->logMsg("Add encoding ".$encoding);
			}
			else{
				$this->logMsg("Ignoring encoding. Encoding has no allowed value: ".$encoding);
			}
		}


		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $COMANDO);

		// Get response from the server.
		$httpResponse = curl_exec($ch);


		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200){
			$this->logMsg("Server Altiria response: ".$httpResponse);

			if (strstr($httpResponse,"ERROR errNum")){
				$this->logMsg("Error sending SMS: ".$httpResponse);
				return false;
			}
			else
				$return = $httpResponse;
		}
		else{
			$this->logMsg("Error sending SMS: ".curl_error($ch).'('.curl_errno($ch).')'.$httpResponse);

			$return = false;
		}

		curl_close($ch);
		return $return;
	}


	public function getCredit() {
		$return=false;
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded; charset=UTF-8'));
		curl_setopt($ch, CURLOPT_HEADER, false);
		// Max timeout in seconds to complete http request
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);



		$COMANDO='cmd=getcredit&login='.$this->getLogin().'&passwd='.$this->getPassword();

		//domainId solo es necesario si el login no es un email
		$domainId=$this->getDomainId();
		$this->logMsg('Dominio: '.$domainId.'.');
		if (!isset($domainId) || empty($domainId)) {
			$this->logMsg("NO domainId");
		}
		else{
			$COMANDO.='&domainId='.$this->getDomainId();
			$this->logMsg("Add domainId ".$this->getDomainId());
		}


		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $COMANDO);

		// Get response from the server.
		$httpResponse = curl_exec($ch);


		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200){
			$this->logMsg("Server Altiria response: ".$httpResponse);

			if (strstr($httpResponse,"ERROR errNum")){
				$this->logMsg("Error asking SMS credit: ".$httpResponse);
				$return = false;
			}
			else
				$return = $httpResponse;
		}
		else{
			$this->logMsg("Error asking SMS credit: ".curl_error($ch).'('.curl_errno($ch).')'.$httpResponse);

			$return = false;
		}

		curl_close($ch);
		return $return;
	}

	public function logMsg($msg) {
        $slug = '';
		if ($this->getDebug()===true){
		    $slug=(date(DATE_RFC2822)." : ".$msg."</br>");
		    error_log("\n".date(DATE_RFC2822)." : ".$msg."\r\n", 3, "app.log");
		}
	}
}
?>
