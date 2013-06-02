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
		
		$dateInput 	= mktime(0, 0, 0, substr($date, 3, 2), substr($date, 1, 2), substr($date, 6, 2));
		$dateNow 	= mktime(0, 0, 0, substr($now, 3, 2), substr($now, 1, 2), substr($now, 6, 2));
		
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

?>