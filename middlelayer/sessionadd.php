<?php
require_once('config.php');
date_default_timezone_set($timezone);
error_reporting(E_ALL);
//get session from an authed user. if isset else 

$sessionkey = $_GET['sessionkey'];
session_start();
//send back the same json as index.php, except include a string we can test for
if(isset($_SESSION['coffeelogin']) && isset($sessionkey) && $_SESSION['coffeelogin'] === $sessionkey){
	echo "success";
	
	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$stmt = $dbo->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => date('Y:m:d:H:i:s')));
	//this would be a perfect time to generate a file which has calculation made from the data
	//include('makestats.php');
}else{
	echo "failed";
}
?>