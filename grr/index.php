<?php
date_default_timezone_set('America/Detroit');

$one = htmlspecialchars($_GET['vone']);
$two = htmlspecialchars($_GET['vtwo']);
if($one === "4512" && $two === "trebuchet271ii45"){
	$date = date('Y:m:d:H:i:s');
	$db = new PDO('mysql:host=localhost;dbname=howmany1_coffeeconsumption', "howmany1_coffee", "a2FT^my=$+{p");
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
	echo "plusone";
	session_start();
	$_SESSION['login']=$one;
	echo $_SESSION['login'];
}
else{
	echo "you failed again";
}
function addOne(){
	$date = date('Y:m:d:H:i:s');
	$db = new PDO('mysql:host=localhost;dbname=howmany1_coffeeconsumption', "howmany1_coffee", "a2FT^my=$+{p");
	$stmt = $db->prepare("INSERT INTO cups (time) VALUES (:time)");
	$stmt->execute(array(':time' => $date));
	echo "plusone";
}
?>