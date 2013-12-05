<?php
date_default_timezone_set('America/Detroit');

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);
if($one === "password" && $two === "password"){
	$date = date('Y:m:d:H:i:s');
	$db = new PDO('mysql:host=localhost;dbname=dbname', "dbuser", "dbpass");
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
	echo "plusone";
	session_start();
	$_SESSION['login']=$one;
	//echo $_SESSION['login'];
	$json = array(
		"authkey" => "plusone",
		"userSession" => $_SESSION['login']
	);
	echo json_encode($json);
}
else{
	echo "you failed again";
}
function addOne(){
	$date = date('Y:m:d:H:i:s');
	$db = new PDO('mysql:host=localhost;dbname=dbname', "dbuser", "pass");
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
	echo "plusone";
}
?>
