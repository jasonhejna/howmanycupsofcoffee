<?php
	require_once('config.php');
	date_default_timezone_set($timezone);
	error_reporting(E_ALL);

	$dbo = new PDO('mysql:host='.$dbhostaddress.';dbname='.$dbname, $dbuser, $dbpass);
	$gett = $dbo->prepare("SELECT cupnumber,time FROM cups WHERE `time` BETWEEN (:time) - INTERVAL 12 HOUR AND (:time)");//SELECT '2006-02-31' + INTERVAL 0 DAY;
	$gett->execute(array(':time' => date('Y-m-d H:i:s')));
	$done= $gett->fetchAll();
	//print_r($done);

	$arrayCount = count($done);
	//echo $arrayCount;
	$i = 0;
	do {
		if($i < $arrayCount -1){
			$interval = timeDiff($done[$i]['time'],$done[$i+1]['time']);
		}
		if($interval > (6*60*60)){
			$arrayString .= ",['".$done[$i]['time']."', 0]";
			$interval = 0;
		}
		if($i>0 && $interval <= (6*60*60)){

			if($i===1){
				$degradedAnsw = 1-((1/(6*60*60))*$interval);
			}
			if($i>=$arrayCount -1){
				$durationseconds = $degradedAnsw*(6*60*60);
				$dateinsec=strtotime($done[$i]['time']);
				$newdate=$dateinsec+$durationseconds;
				$newdate = date('Y-m-d H:i:s',$newdate);
				$degradedAnsw=0;
				$arrayString .= ",['".$newdate."', ".$degradedAnsw."]";
			}
			else{

			$arrayString .= ",['".$done[$i]['time']."', ".$degradedAnsw."]";
			
			$newAnsw = 1+$degradedAnsw;//add the new cup of coffee i.e. 1
			if($degradedAnsw>2){
				$degradedAnsw =0;
				echo "greater2";
			}
			$arrayString .= ",['".$done[$i]['time']."', ".$newAnsw."]";

			$degradedAnsw = $newAnsw - (1/(6*60*60))*$interval;
			}
		}
		elseif($i===0) {
			$arrayString = "[['time', 'coffeelevel'],['".$done[$i]['time']."', 1]";
		}

	    $i++;

	} while (!empty($done[$i]));	
	echo $arrayString."]";

	function timeDiff($thisDateTime,$nextDateTime){
			$first_date = strtotime($thisDateTime);
			$second_date = strtotime($nextDateTime);
			$timeAdder = $second_date - $first_date;
			echo $timeAdder.'<br />';
			return $timeAdder;
	}

?>
