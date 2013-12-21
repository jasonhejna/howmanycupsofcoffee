<?php
//validate session if

$sessionkey = $_GET['sessionkey'];

session_start();
if($_SESSION['coffeelogin'] === $sessionkey && isset($sessionkey) && isset($_SESSION['coffeelogin'])){

require_once('config.php');
$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
$igett = $dbo->prepare("SELECT * FROM `cups` ORDER BY `cupnumber` DESC LIMIT 0,1");//SELECT '2008-02-31' + INTERVAL 0 DAY;
$igett->execute();
$done= $igett->fetch();
echo $done[1];

}else{
	echo "notvalid";
}

?>