<?php   

function checkDateFormatValid($date) {
	if(empty($date)) { return false; }
	return check_date($date, "dmY", ".");	
}
function check_date($date, $format, $sep) {
	$pos1    = strpos($format, 'd');
	$pos2    = strpos($format, 'm');
	$pos3    = strpos($format, 'Y'); 

	$check    = explode($sep,$date);
	
	return checkdate($check[$pos2],$check[$pos1],$check[$pos3]);
}

/* Dateformat: dd.mm.yyyy */
function checkDateNotInFuture($date) {	
	if(checkDateFormatValid($date)) {
		$now = date('d.m.Y');
		
		$dateInput 	= mktime(0, 0, 0, substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4));
		$dateNow 	= mktime(0, 0, 0, substr($now, 3, 2), substr($now, 0, 2), substr($now, 6, 4));
		
		if($dateInput > $dateNow) {
			return false;
		}else {
			return true;
		}
	}
	return false;
}

/* 	
	inputformat: dd.mm.yyyy
	outputformat: yyyy-mm-dd
*/
function formatDateForDatabase($date) {
 	return date('Y-m-d', strtotime($date));
}

/*
	inputformat: m.yyyy
	outputformat: m
*/
function getMonthOrYearFromMonthYear($monthYear, $which) {
	if($which == 'm') {
		return substr($monthYear, 0, strpos($monthYear, "-"));
	} else if($which == 'y') {
		return substr($monthYear, strpos($monthYear, "-")+1);
	}else {
		return 0;
	}
}


function getMonthShortName($month) {
	$monthShortNames = array(1=>"Jan", 2=>"Feb", 3=>"Mär", 4=>"Apr", 5=>"Mai", 6=>"Jun", 7=>"Jul", 8=>"Aug", 9=>"Sep", 10=>"Okt", 11=>"Nov", 12=>"Dez");

	return $monthShortNames[$month];
}

?>