<?php

/*
* Neato Botvac Client
* Used to authorize the client and to fetch registered robots for the client
*
* PHP port based on https://github.com/kangguru/botvac
*
* Author: Tom Rosenback tom.rosenback@gmail.com 2016
*/

require_once("NeatoBotvacApi.php");

class NeatoBotvacClient {
	protected $baseUrl = "https://beehive.neatocloud.com";
	public $token;

	public function __construct($token = false) {
		$this->token = $token;
	}

	public function authorize($email, $password, $force = false) {
		if($this->token === false || $force === true) {
			$result = NeatoBotvacApi::request($this->baseUrl."/sessions",
				array(
					"platform" 	=> "ios",
					"email" 		=> $email,
					"token" 		=> bin2hex(openssl_random_pseudo_bytes(32)),
					"password" 	=> $password
				)
			);

			if(isset($result["access_token"])) {
				$this->token = $result["access_token"];
			}
		}

		return $this->token;
	}

	public function reauthorize($email, $password) {
		return $this->authorize($email, $password, true);
	}

	public function getRobots($token = false) {
		$result = array("message" => "no token");

		if($token !== false) {
			$this->token = $token;
		}

		if($this->token !== false) {
			$result = NeatoBotvacApi::request($this->baseUrl."/dashboard", null, "GET", array("Authorization: Token token=".$this->token));
		}

		return $result;
	}
}

?>
