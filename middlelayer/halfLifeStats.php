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
	//echo $arrayCount;
	$i = 0;
	do {
	    //echo "<br />".$done[$i]['time'];
	    
	    //echo slopeIntercept($done[$i]['time'],$i,$arrayCount);
		$interval = timeDiff($done[$i]['time'],$i);
		if($i>0 && $arrayCount >= $i){
			$arrayString .= ",['".$done[$i]['time']."', ".$degradedAnsw."]";
			
			$newAnsw = ((1/(6*60*60))*$interval);//add the new cup of coffee i.e. 1
			if($newAnsw>2){
				$newAnsw =0;
			}
			//print new ANSW
			$arrayString .= ",['".$done[$i]['time']."', ".$newAnsw."]";

			$degradedAnsw = ((1/(6*60*60))*$interval) - $newAnsw;
		}
		elseif($i===0) {
			//start creating the Google array, and add the first time with a value of 1
			$degradedAnsw = 1 - (1/(6*60*60))*$interval;
			$arrayString = "[['time', 'coffeelevel'],['".$done[$i]['time']."', 1]";

		}
		if($arrayCount <= $i){
			//done, wrap up
			$arrayString .= "]";
			echo $arrayString;
		}
	    $i++;

	} while (!empty($done[$i]));
	echo $arrayString;



	function timeDiff($thisDateTime,$i){
		if($i>0){
			//$timeDiff = abs(strtotime($dateTime) - strtotime($oldDateTime));
			$first_date = new DateTime($oldDateTime);
			$second_date = new DateTime($thisDateTime);

			$timeDiff = $first_date->diff($second_date);
			$oldDateTime = $thisDateTime;
			
			$timeAdder = (($timeDiff->h)*(60*60)) + (($timeDiff->m)*60) + $timeDiff->s;
			echo $timeAdder.'<br />';
			return $timeAdder;
		}
		elseif($i===0) {
			$oldDateTime = $thisDateTime;
			//return "elsemet";
		}
	}


/*        var data = google.visualization.arrayToDataTable(
		[
          ['time', 'coffeelevel'],
          ['2013-12-22 16:25:40',  1],
          ['2013-12-22 16:25:40',  1.76733334]
        ]
        );*/	
/*function slopeIntercept($time,$i,$arrayCount) {
		//echo $i;
		$interval = timeDiff($time,$i);
		if($i>0 && $arrayCount >= $i){
			$arrayString .= ",['".$time."', ".$degradedAnsw."]";
			
			$newAnsw = ((1/(6*60*60))*$interval)+1;//add the new cup of coffee i.e. 1
			if($newAnsw>2){
				$newAnsw =0;
			}
			//print new ANSW
			$arrayString .= ",['".$time."', ".$newAnsw."]";

			$degradedAnsw = ((1/(6*60*60))*$interval) - $newAnsw;

		}
		elseif($i===0) {
			//start creating the Google array, and add the first time with a value of 1
			$degradedAnsw = 1 - (1/(6*60*60))*$interval;
			$arrayString = "[['time', 'coffeelevel'],['".$time."', 1]";

		}
		if($arrayCount -1 <= $i){
			//done, wrap up
			$arrayString .= "]";
			echo $arrayString;
		}


	}*/
?>