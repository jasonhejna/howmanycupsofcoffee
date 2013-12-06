<?php
date_default_timezone_set('America/Detroit');

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);
if($one === "password" && $two === "password"){
	session_start();
	$_SESSION['login']=$one;
	$json = array(
		"authkey" => "plusone",
		"userSession" => $_SESSION['login']
	);
	echo json_encode($json);
	addOne();
}
else{
	echo "you failed again";
}
function addOne(){
	$date = date('Y:m:d:H:i:s');
	require_once(dbConfig.php)
	$db = new PDO('mysql:host=localhost;dbname='.$dbname, $dbuser, $dbpass);
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
}
?>
