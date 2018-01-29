<pre>
<?php

require("../NeatoBotvacClient.php");
require("../NeatoBotvacRobot.php");

$email = "user@email.com";
$password = "secretpassword";
$token = false; // Token returned from authorize method

/*
 If you already have a secret and serial, there is no need to authorize, skip this part and go directly to the fun stuff
*/

$client = new NeatoBotvacClient($token);
$robots = array();
$event = array();

$auth = $client->authorize($email, $password);

if($auth !== false) {
	echo "Token: ".$auth."<br />";
	$result = $client->getRobots();

	if($result !== false) {
		foreach ($result["robots"] as $robot) {
			$robots[] = new NeatoBotvacRobot($robot["serial"], $robot["secret_key"], $robot["model"] );
		}
	}
} else {
	echo "Unable to authorize";
}

/* Doing actions against the robot(s) */

foreach ($robots as $robot) {
	print_r($robot->getState());
	print_r($robot->getSchedule());
	
	print_r($robot->setName("ROBOT", $auth));
		
	// Set Schedule for Thursday and Sunday at 11:20 o'clock without eco mode 
	// (Sunday = 0 / Monday = 1 and so on)
	$event = array(
		array("startTime" => "11:20", "mode" => 2, "day" => 4),
		array("startTime" => "11:20", "mode" => 2, "day" => 0)
	);
	$robotClass->setSchedule($event);
}

?>
</pre>
