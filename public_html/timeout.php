<?php
header('Access-Control-Allow-Origin:*');
//header('Content-type: application/json; charset=utf-8');
header('Content-type: application/javascript');
$times=file_get_contents("db_timeout.txt");
$timeset=array();
//var_dump($timeset);
if (isset($_POST['time'])) {
	$log_line=date('d.m.Y H:i:s').'; '.$_POST['time'].'; '.$_POST['city']."; ".$_POST['first_name']."; ".$_POST['last_name']."; ".$_POST['Email']."; ".$_POST['Phone']."\n";
	file_put_contents('log.log', $log_line, FILE_APPEND);

	$curator=preg_quote($_POST['city'], '/');

	preg_match_all("/$curator>([\d]{0,2}[A-я ]{0,20}[\d:]+)>(\d+)/Uis",$times, $timecount);
	for ($i=0; $i<count($timecount[0]); $i++) {
		$timeset[$timecount[1][$i]]=$timecount[2][$i];
	}
	
	$new_count=(int)$timeset[$_POST['time']]-1;
	file_put_contents('log.log', $new_count."\n", FILE_APPEND);
	// если клиент переклацал кнопку
	if ($new_count<0) $new_count=0;

	$linesearch=$_POST['city'].'>'.$_POST['time'].'>'.$timeset[$_POST['time']];
	$newline=$_POST['city'].'>'.$_POST['time'].'>'.$new_count;
	$nw_data=str_replace($linesearch, $newline, $times);
	
	file_put_contents('db_timeout.txt', $nw_data);
	
	exit();
}

if (isset($_GET['city'])) {
	$curator=preg_quote($_GET['city'], '/');
	preg_match_all("/$curator>([\d]{0,2}[A-я ]{5,20}[\d:]+)>([\d]+)/Uis",$times, $timecount);
	for ($i=0; $i<count($timecount[0]); $i++) {
		$timeset[$timecount[1][$i]]=$timecount[2][$i];
	}
	//file_put_contents('log.log', $curator."\n",FILE_APPEND);
	echo json_encode($timeset, true);
//$callback = $_GET['callback'];
//echo $callback . '(' . json_encode($timeset, true) . ')';
} else {
	preg_match_all("/([^\d>]+)>([\d]{0,2}[A-я ]{0,20}[\d:]+)>(\d+)/Uis",$times, $timecount);
	$timeset=array();
	for ($i=0; $i<count($timecount[0]); $i++) {
		$timeset[]=$timecount[3][$i];
	}
	echo json_encode($timeset, true);
}




