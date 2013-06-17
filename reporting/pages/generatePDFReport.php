<?php
	require('../../shared/authenticationController.php');
	require('../../shared/fpdf.php');
	require('../../shared/fpdm.php');
	require('../../shared/font/helvetica.php');
	require('../../shared/font/helveticab.php');
	require('../../shared/font/helveticabi.php');
	require('../../shared/font/helveticai.php');
	require('../util/db.inc.php');
	require('../util/dateFunctions.inc.php');
	require('../util/numberFunctions.inc.php');
	require('../util/dashboardFunctions.inc.php');
	require('../util/flexibleReportsFunctions.inc.php');
	require('../util/pdf.class.php');

	
	$indicatorId = $_GET['allIndicatorsSelect'];
	$date = $_GET['date'];
	$dateFrom = $_GET['dateFrom']; // dd.mm.yyyy
	$dateTo = $_GET['dateTo']; // dd.mm.yyyy
	
	if(checkFlexibleIndicator($indicatorId)) {
		if($indicatorId == 5) {
			if(checkDateFormatValid($date)) {
				$dataCorrect = true;
			}
		}else {
			if(checkDateFormatValid($dateFrom) && 
				checkDateFormatValid($dateTo) && 
				checkDateNotInFuture($dateFrom) && 
				checkDateFromBeforeDateTo($dateFrom, $dateTo)) {
				$dataCorrect = true;
			}else {
				$dataCorrect = false;
			}
		
		
		}
	}  
		
	if($dataCorrect) {	
		$dateDB = formatDateForDatabase($date); // yyyy-mm-dd
		$dateFromDB = formatDateForDatabase($dateFrom); // yyyy-mm-dd
		$dateToDB = formatDateForDatabase($dateTo); // yyyy-mm-dd
		
		switch($indicatorId) {
			case 1: // Anzahl Angebote (KZ)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$sumOffers = getOfferSum("sum", $dateFromDB, $dateToDB);
				generateOfferPDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $sumOffers);
				break;
			case 2: // Anzahl Aufträge (KZ)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$sumOrders = getOrdersSum("sum", $dateFromDB, $dateToDB);
				generateOrdersPDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $sumOrders);
				break;
			case 3: // Verhältnis Angebote/Aufträge (KZ)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$sumOffers = getOfferSum("sum", $dateFromDB, $dateToDB);
				$sumOrders = getOrdersSum("sum", $dateFromDB, $dateToDB);
				generateRelationOfferOrderPDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $sumOffers, $sumOrders);
				break;
			case 4: // Gesamtumsatz (KZ)
			case 6: // Gesamtumsatz (TAB)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$totalRevenue = getTotalRevenue($indicatorId, 'pdf');
				generateTotalRevenuePDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $totalRevenue);
				break;
			case 5: // Mitarbeiterstatistik (TAB)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$employees = getEmployeeStatistik($indicatorId, $dateDB, 'pdf');
				generateEmployeeStatistikPDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $employees);
				break;
			case 7: // Umsatz und Anzahl Bestellung pro Kunde (TAB)
				$indiNameAndType = getIndicatorNameAndType($indicatorId);
				$turnoverAndQuantity = getTurnoverAndQuantityPerCustomer($indicatorId, 'pdf');
				generateTurnoverAndQuantityPerCustomerPDF($indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo, $turnoverAndQuantity);
				break;
		}		
	}else {
		echo "sorry can't generate PDF.";
	}

function initPDF($indiName, $indiType, $dateFrom, $dateTo) {
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Helvetica', 'B', 14);
	$pdf->Cell(0, 5, "$indiName ($indiType)");
	$pdf->Ln(10);
	$pdf->SetFont('Helvetica', '', 12);
	$pdf->Cell(0, 5, "Zeitraum von: ".$dateFrom." - Zeitraum bis: ".$dateTo);
	$pdf->Ln(10);
	return $pdf;
}

function generateOfferPDF($indiName, $indiType, $dateFrom, $dateTo, $sumOffers) {
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array($indiName . " (".$indiType.")");
	$data = array(array($sumOffers));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);

	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateOrdersPDF($indiName, $indiType, $dateFrom, $dateTo, $sumOrders) {
	// todo add regex for replacing umlauts
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array($indiName . " (".$indiType.")");
	$data = array(array($sumOrders));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateRelationOfferOrderPDF($indiName, $indiType, $dateFrom, $dateTo, $sumOffers, $sumOrders) {
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array("Anzahl Angebote (KZ)", "Anzahl Aufträge (KZ)", "Verhältnis");
	$relation = round( (($sumOrders / $sumOffers) * 100), 2) . " %";
	$data = array(array($sumOffers, $sumOrders, $relation));
	$colWidth = array(50, 50, 40);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');	
}

function generateTotalRevenuePDF($indiName, $indiType, $dateFrom, $dateTo, $totalRevenue) {
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array($indiName . " (".$indiType.")");
	$data = array(array(str_replace('.',',',$totalRevenue)." Euro"));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateEmployeeStatistikPDF($indiName, $indiType, $dateFrom, $dateTo, $employees) {
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array("Abteilung", "Anz. MA");
	$data = $employees;
	$colWidth = array(50, 50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateTurnoverAndQuantityPerCustomerPDF($indiName, $indiType, $dateFrom, $dateTo, $turnoverAndQuantity) {
	$pdf = initPDF($indiName, $indiType, $dateFrom, $dateTo);
	
	$header = array("Vorname", "Nachname", "Anz. Bestellungen", "Umsatz");
	$data = $turnoverAndQuantity; // todo iterate and str_replace the umsatz and add euro
	$colWidth = array(40, 40, 50, 50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiName.'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}


?>