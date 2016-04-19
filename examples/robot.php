<pre>
<?php

/*
* Simple example of how to start cleaning, this example requires that you already have your robot serial and secret (which you get in the client example)
*/

require("../NeatoBotvacRobot.php");

$serial = "robotserial";
$secret = "robotsecret";

$robot = new NeatoBotvacRobot($serial, $secret);
print_r($robot->startCleaning());

// sleep(20);
// print_r($robot->pauseCleaning());
// print_r($robot->sendToBase());

?>
</pre>
