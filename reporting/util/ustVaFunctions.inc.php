<?php
require('../shared/fpdf.php');
require('../shared/fpdm.php');

function generatePdf($monthYear) {
	$month = getMonthOrYearFromMonthYear($monthYear, 'm');
	
	$netSum = getNetSum($monthYear);
	$netTwentySum = getNetTaxSum($monthYear, 20);
	$netTenSum = getNetTaxSum($monthYear, 10);
	$vstSum = getVstSum($monthYear);
	
	if( ($netSum > -1) && ($netTwentySum > -1) && ($netTenSum > -1) && ($vstSum > -1)) {
	
		$fields = array(
			'Text01'    	=> 'Finanzamt 6/7/15 FA(15)\nMarxergasse 4\nA-1060 Wien',
			'Zahl03' 		=> '05',
			'Zahl02_1'    	=> '123',
			'Zahl02_2'   	=> '4567',
			'Text01_m'		=> $month, 
			'Text03'		=> 'FELIX MARTIN HI-FI UND VIDEOSTUDIOS',
			'Text05'		=> 'NEUBAUGASSE',
			'Text06'		=> '15',
			'Text07c'		=> '+43/1/2135782',
			'Text07d'		=> '1060',
			'Text07e'		=> 'WIEN',
			'Zahl101'		=> $netSum, 
			'Zahl115a'		=> $netTwentySum, 
			'Zahl116a'		=> $netTenSum, 
			'Zahl133'		=> $vstSum, 
			'Tagesdatum2'	=> date("d.m.Y")
		);
		
		$inputfile = "u30".DIRECTORY_SEPARATOR."u30-2013-fosy.pdf";
		$pdf = new FPDM($inputfile); 
		$pdf->Load($fields, false); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
		$pdf->Merge();
		// I: Inline to the browser; 
		// D: Inline to the browser and force a file download
		// F: Save to local file
		// S: Return document as string
		$filename = "u30".DIRECTORY_SEPARATOR."u30_".$month."-2013.pdf";
		$pdf->Output($filename, 'F');
		return $filename; 
	}else {
		return -1;
	}
}

// Zahl101:
// Gesamtbetrag der Bemessungsgrundlage fuer Lieferungen und sonstige Leistungen: 
// summe von net für datum von bis, where tax_type ust
function getNetSum($monthYear) {
	// 1. generate from monthYear database dates
	$dateFrom = getDateFrom($monthYear);
	$dateTo = getDateTo($monthYear);
	
	// 2. get the sum 
	$query = "SELECT sum(net) AS sum FROM invoice i JOIN tax_type tt ON i.fk_tax_type_id = tt.id WHERE date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND tt.type='ust'";
	$result = mysql_query($query);
	
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			return $row['sum']; // 3. return the sum 
		}
	} else {
		showErrorMsg(mysql_errno(), $query);
	}
	
	return -1; // on error, we return -1
}

// Zahl115a & Zahl116a:
// Davon zu versteuern mit 20%
// Davon zu versteuern mit 10%
function getNetTaxSum($monthYear, $taxRate) {
	// 1. generate from monthYear database dates
	$dateFrom = getDateFrom($monthYear);
	$dateTo = getDateTo($monthYear);
	
	// 2. get the sum
	$query = "SELECT sum(net) AS sum FROM invoice i JOIN tax_type tt ON i.fk_tax_type_id = tt.id JOIN tax_rate tr ON i.fk_tax_rate_id = tr.id WHERE date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND tt.type='ust' AND tr.rate=".$taxRate;
	$result = mysql_query($query);
	
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			return $row['sum'];
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}
	
	return -1; // on error, we return -1
}

// Zahl133:
// Gesamtsumme der Vorsteuer
function getVstSum($monthYear) {
	// 1. generate from monthYear database dates
	$dateFrom = getDateFrom($monthYear);
	$dateTo = getDateTo($monthYear);
	
	// 2. get the sum
	$query = "SELECT sum(tax) AS sum FROM invoice i JOIN tax_type tt ON i.fk_tax_type_id = tt.id WHERE date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND tt.type='vst'";
	$result = mysql_query($query);
	
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			return $row['sum'];
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}
	
	return -1; // on error, we return -1
}


function saveUstVa($monthYear, $path) {
	$month = getMonthOrYearFromMonthYear($monthYear, 'm');
	$year = getMonthOrYearFromMonthYear($monthYear, 'y');
	$query = "INSERT INTO tax_report (month, year, document) VALUES ($month, $year, '$path')";
	$result = mysql_query($query);
	
	if($result && mysql_affected_rows()) {
		redirect("ustVaPrintedSuccess");
	}else {
		showErrorMsg(mysql_errno(), $query);
	}
}

?>