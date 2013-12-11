<?php
//Please use a difficult to crack password for $web_password, and a $web_username greater than four characters. I can't save you from yourself
//Also, be aware, you should have ssl on the web server your running this on. Or else you're vulnerable to session injection attacks.
$timezone		= 'America/Detroit'; //for a full list of time zones in php see http://php.net/manual/en/timezones.php
$web_secret		= '1234';
$webusername	= 'myusername';
$webpassword	= 'mypassword';
$dbhostaddress	= 'localhost';
$dbname 		= 'mydbname';
$dbuser			= 'mydbusername';
$dbpass			= 'mydbpassword';
?>