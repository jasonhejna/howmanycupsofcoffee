<?php
	require_once('config.php');
	date_default_timezone_set($timezone);
	error_reporting(E_ALL);

	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$gett = $dbo->prepare("SELECT cupnumber,time FROM cups WHERE `time` BETWEEN (:time) - INTERVAL 6 HOUR AND (:time)");//SELECT '2008-02-31' + INTERVAL 0 DAY;
	$gett->execute(array(':time' => date('Y-m-d H:i:s')));
	$done= $gett->fetchAll();
	//print_r($done);

	$arrayCount = count($done);
	$i = 0;
	do {
	    //echo "<br />".$done[$i]['time'];
	    slopeIntercept($done[$i]['time'],$i,$arrayCount);
	    $i++;
	} while (!empty($done[$i]));

	function slopeIntercept($time,$i,$arrayCount) {
		$interval = timeDiff($time,$i);
		if($i>0 && $arrayCount !== $i){
			$arrayString += ",['".$time."', ".$degradedAnsw."]";
			
			if($interval<2){
				$newAnsw = ((1/(6*60*60))*$interval)+1;//add the new cup of coffee i.e. 1
			}
			else{
				$degradedAnsw = 0;
			}

		}
		elseif($i===0) {
			//start creating the Google array, and add the first time with a value of 1
			$degradedAnsw = 1 - (1/(6*60*60))*$interval;
			$arrayString = "[['time', 'coffeelevel'],['".$time."', 1]";

		}
		if($arrayCount === $i){
			//done, wrap up
		}

	}

	function timeDiff($dateTime,$i){
		if($i>0){
			$timeDiff = strtotime($dateTime) - strtotime($oldDateTime);
			$oldDateTime = $dateTime;
			return $timeDiff;
		}
		else {
			$oldDateTime = $dateTime;
			return "elsemet";
		}
	}


/*        var data = google.visualization.arrayToDataTable(
		[
          ['time', 'coffeelevel'],
          ['2013-12-22 16:25:40',  1],
          ['2013-12-22 16:25:40',  1.76733334]
        ]
        );*/
?>