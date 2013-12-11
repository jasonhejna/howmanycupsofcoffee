<?php
date_default_timezone_set('America/Detroit');
error_reporting(E_ALL);
//get session from an authed user. if isset else 
session_start();
$sessionkey = htmlspecialchars($_GET['sessionkey']);

//send back the same json as index.php, except include a string we can test for
if($_SESSION['coffeelogin'] === $sessionkey){
	echo "success";
	require_once('config.php');
	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$stmt = $dbo->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => date('Y:m:d:H:i:s')));
	//this would be a perfect time to generate a file which has calculation made from the data
}else{
	echo "failed";
}
?>