<?php
	/*error_reporting(E_ALL & ~ E_NOTICE);
	ini_set ('display_errors', 'On');*/

	$user 		= 	"fosy";
	$host 		= 	"localhost";
	$password 	= 	"fosyPassword";
	$database	= 	"fosy";
	
	$db = mysql_connect($host, $user, $password) or die("Keine Verbindung!");
	
	mysql_select_db($database, $db) or die("Konnte Datenbank nicht finden!");		
	
	
	function showErrorMsg($mysqlError, $query) {
		$message  = 'Ungültige Abfrage: ' . $mysqlError . "\n";
		$message .= 'Gesamte Abfrage: ' . $query;
		die($message);
	}
?>		
