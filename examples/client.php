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
}

?>
</pre>
