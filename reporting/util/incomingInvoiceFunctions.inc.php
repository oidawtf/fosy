<?php
// TODO check format method for fixing user bad input
function checkBelegNr($belegNr) {
	$belegNr = trim($belegNr);
	if(empty($belegNr)) {
		return false;
	}
	return true;
}

// TODO check format method for fixing user bad input
function checkBruttoBetrag($brutto) {
	$brutto = trim($brutto);
	if(empty($brutto) || !is_numeric($brutto) || $brutto <= 0) {
		return false;
	}
	return true;
}

function saveIncomingInvoice($date, $belegNr, $bruttoBetrag, $tax) {
	// TODO maybe have to check the data
	
	switch($tax) {
		case "10":
			$vst = $bruttoBetrag / 11;
			break;
		case "20":
			$vst = $bruttoBetrag / 6;
			break;
	}
	
	$nettoBetrag = $bruttoBetrag - $vst;
	
	$taxType = getTaxTypeId("vst");

	$date = formatDateForDatabase($date);
	// todo format netto-betrag
	$query = "INSERT INTO tax (date, value, businessRecordNumber, fk_tax_type_id) VALUES ('$date', $nettoBetrag, '$belegNr', $taxType)";
	
	$result = mysql_query($query);
	
	if($result && mysql_affected_rows()) {
		// TODO make a readirect
		echo "now check the database for new insert <br>";
	}else {
		$message  = 'Ungültige Abfrage: ' . mysql_error() . "\n";
		$message .= 'Gesamte Abfrage: ' . $query;
		die($message);
	}
}

function getTaxTypeId($type) {
	$query = "SELECT id FROM tax_type WHERE type='$type'";
	$result = mysql_query($query);
	
	if ($result && mysql_num_rows($result)) {
		while($z= mysql_fetch_assoc($result)){
			return $z['id'];
		}
	}else {
		$message  = 'Ungültige Abfrage: ' . mysql_error() . "\n";
		$message .= 'Gesamte Abfrage: ' . $query;
		die($message);
	}
	
}
?>