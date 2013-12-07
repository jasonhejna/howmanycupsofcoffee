<?php
date_default_timezone_set('America/Detroit');
error_reporting(E_ALL);

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);
require_once('config.php');
if($one === $webusername && $two === $webpassword){
$encryptedone = sha1($two.$one);
	$jsondata = array(
		"authkey" => "plusone",
		"sessionkey" => $encryptedone
	);
	echo json_encode($jsondata);
	session_start();
	$_SESSION['coffeelogin']=$encryptedone;
	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$stmt = $dbo->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => date('Y:m:d:H:i:s')));
}
else{
	echo "you failed again";
}

?>
