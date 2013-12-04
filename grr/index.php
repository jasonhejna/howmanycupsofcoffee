<?php
date_default_timezone_set('America/Detroit');

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);
if($one === "userpassword" && $two === "userpassword"){
	$date = date('Y:m:d:H:i:s');
	$db = new PDO('mysql:host=localhost;dbname=dbname', "dbuser", "dbpassword");
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
	echo "plusone";
}
else{
	echo "you failed again";
}
?>