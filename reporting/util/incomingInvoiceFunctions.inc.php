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

function saveIncominginvoice($date, $belegNr, $bruttoBetrag, $rate) {
	if(checkDateFormatValid($date) && checkDateNotInFuture($date) &&  checkBelegNr($belegNr) && checkBruttoBetrag($bruttoBetrag)) {
		
		$bruttoBetrag = floatConverter($bruttoBetrag, array('single_dot_as_decimal'=> TRUE));

		// TODO write short if?
		if($rate==10) { (float)$vst = $bruttoBetrag / 11; }
		else if($rate==20) { (float)$vst = $bruttoBetrag / 6; }
	
		$nettoBetrag = $bruttoBetrag - $vst;
		$taxType = getTaxTypeId("vst");
		$taxRate = getTaxRateId($rate);
		$date = formatDateForDatabase($date);
	
		$query = "INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ($taxType, $taxRate, '$date', $bruttoBetrag, $nettoBetrag, $vst, '$belegNr')";

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
		while($z = mysql_fetch_assoc($result)){
			return $z['id'];
		}
	}else {
		showErrorMsg(mysql_errno(), $query);
	}
}

function getTaxRateId($rate) {
	$query = "SELECT id FROM tax_rate WHERE rate='$rate'";
	$result = mysql_query($query);
	
	if($result && mysql_num_rows($result)) {
		while($z = mysql_fetch_assoc($result)) {
			return $z['id'];
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}
}
?>