<?php

/*
* Neato Botvac Robot
* Makes requests against the robot
*
* PHP port based on https://github.com/kangguru/botvac
*
* Author: Tom Rosenback tom.rosenback@gmail.com  2016
*/

require_once("NeatoBotvacApi.php");

class NeatoBotvacRobot {
	protected $baseUrl = "https://nucleo.neatocloud.com/vendors/neato/robots/";
	protected $serial;
	protected $secret;

	public function __construct($serial, $secret) {
		$this->serial = $serial;
		$this->secret = $secret;
	}

	public function getState() {
		return $this->doAction("getRobotState");
	}

	public function startCleaning() {
		$params = array("category" => 2, "mode" => 2, "modifier" => 2);
		return $this->doAction("startCleaning", $params);
	}
	
	public function startEcoCleaning() {
		$params = array("category" => 2, "mode" => 1, "modifier" => 2);
		return $this->doAction("startCleaning", $params);
	}

	public function pauseCleaning() {
		return $this->doAction("pauseCleaning");
	}
	
	public function resumeCleaning() {
		return $this->doAction("resumeCleaning");
	}

	public function stopCleaning() {
		return $this->doAction("stopCleaning");
	}

	public function sendToBase() {
		return $this->doAction("sendToBase");
	}

	public function enableSchedule() {
		return $this->doAction("enableSchedule");
	}

	public function disableSchedule() {
		return $this->doAction("disableSchedule");
	}

	public function getSchedule() {
		return $this->doAction("getSchedule");
	}

	protected function doAction($command, $params = false) {
		$result = array("message" => "no serial or secret");

		if($this->serial !== false && $this->secret !== false) {
			$payload = array("reqId" => "1", "cmd" => $command);

			if($params !== false) {
				$payload["params"] = $params;
			}

			$payload = json_encode($payload);
			$date = gmdate("D, d M Y H:i:s")." GMT";
			$data = implode("\n", array(strtolower($this->serial), $date, $payload));
			$hmac = hash_hmac("sha256", $data, $this->secret);

			$headers = array(
	    	"Date: ".$date,
	    	"Authorization: NEATOAPP ".$hmac
			);

			$result = NeatoBotvacApi::request($this->baseUrl.$this->serial."/messages", $payload, "POST", $headers);
		}

		return $result;
	}


}
