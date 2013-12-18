<?php
require_once('config.php');
date_default_timezone_set($timezone);
error_reporting(E_ALL);

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);

if($one === $webusername && $two === $webpassword){
	session_start();
	if( isset($_SESSION['coffeelogin']) ){
		//we have another logged in user
		$encryptedone = $_SESSION['coffeelogin'];
	}else{
		$encryptedone = sha1($two.$one);
		$_SESSION['coffeelogin']=$encryptedone;
	}

	$jsondata = array(
		"authkey" => "plusone",
		"sessionkey" => $encryptedone
	);
	echo json_encode($jsondata);

	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$stmt = $dbo->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => date('Y:m:d:H:i:s')));
	//this would be a perfect time to generate a file which has calculation made from the data
	//include('makestats.php');
}
else{
	echo "you failed again";
}

?>
