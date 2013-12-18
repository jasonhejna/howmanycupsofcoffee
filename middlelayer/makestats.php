<?php
	require_once('config.php');
	date_default_timezone_set($timezone);
	error_reporting(E_ALL);
	//not tested yet
	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$gett = $dbo->prepare("SELECT (:time) + INTERVAL 0 DAY FROM cups");//SELECT '2008-02-31' + INTERVAL 0 DAY;
	$gett->execute(array(':time' => date('Y-m-d H:i:s')));
?>