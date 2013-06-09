<?php
function checkBelegNr($belegNr) {
	$belegNr = trim($belegNr);
	if(empty($belegNr)) {
		return false;
	}
	return true;
}

function checkBruttoBetrag($brutto) {
	$brutto = floatConverter($brutto, array('single_dot_as_decimal'=> TRUE));
	
	if(empty($brutto) || !is_float($brutto) || $brutto <= 0) {
		return false;
	}
	return true;
}

function saveIncominginvoice($date, $belegNr, $bruttoBetrag, $tax) {
	if(checkDateFormatValid($_POST['date']) && checkDateNotInFuture($_POST['date']) &&  checkBelegNr($_POST['belegNr']) && checkBruttoBetrag($_POST['bruttoBetrag'])) {
		
		$bruttoBetrag = floatConverter($bruttoBetrag, array('single_dot_as_decimal'=> TRUE));

		// TODO write short if?
		if($tax==10) { (float)$vst = $bruttoBetrag / 11; }
		else if($tax==20) { (float)$vst = $bruttoBetrag / 6; }
	
		$taxType = getTaxTypeId("vst");
		$date = formatDateForDatabase($date);
	
		$query = "INSERT INTO tax (date, value, businessRecordNumber, fk_tax_type_id) VALUES ('$date', $vst, '$belegNr', $taxType)";
		$result = mysql_query($query);
	
		if($result && mysql_affected_rows()) {
			redirect("addIncomminginvoiceSuccess");
		}else {
			showErrorMsg(mysql_error(), $query);
		}
	}else {
		echo "never see this msg in the browser! only needed, if anybody called the form outside.";
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
		showErrorMsg(mysql_errno(), $query);
	}
	
}
?>