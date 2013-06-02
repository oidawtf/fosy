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
	// TODO maybe have to check the data because anybody can call the method!
	if(checkDateFormatValid($_POST['date']) && checkDateNotInFuture($_POST['date']) &&  checkBelegNr($_POST['belegNr']) && checkBruttoBetrag($_POST['bruttoBetrag'])) {
	
		// TODO write short if?
		if($tax==10) { $vst = $bruttoBetrag / 11; }
		else if($tax==20) { $vst = $bruttoBetrag / 6; }
	
		$taxType = getTaxTypeId("vst");
		$date = formatDateForDatabase($date);
	
		$query = "INSERT INTO tax (date, value, businessRecordNumber, fk_tax_type_id) VALUES ('$date', $vst, '$belegNr', $taxType)";
		$result = mysql_query($query);
	
		if($result && mysql_affected_rows()) {
			redirect("erErfassenSuccess");
		}else {
			// TODO add method for error-output
			$message  = 'Ungültige Abfrage: ' . mysql_error() . "\n";
			$message .= 'Gesamte Abfrage: ' . $query;
			die($message);
		}
	}else {
		echo "shit happens here";
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
		// TODO add method for error-output
		$message  = 'Ungültige Abfrage: ' . mysql_error() . "\n";
		$message .= 'Gesamte Abfrage: ' . $query;
		die($message);
	}
	
}
?>