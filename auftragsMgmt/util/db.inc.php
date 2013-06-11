<?php
	error_reporting(E_ALL & ~ E_NOTICE);
	ini_set ('display_errors', 'On');

	$db = mysql_connect(
                authenticationController::host,
                authenticationController::user,
                authenticationController::password
                ) or die("Keine Verbindung!");
	
	mysql_select_db(authenticationController::db, $db) or die("Konnte Datenbank nicht finden!");
        mysql_query("SET NAMES 'utf8'");
	
?>		
