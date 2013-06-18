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
				$sumOffers = getOfferSum("sum", $dateFromDB, $dateToDB);
				generateOfferPDF($indicatorId, $dateFrom, $dateTo, $sumOffers);
				break;
			case 2: // Anzahl Aufträge (KZ)
				$sumOrders = getOrdersSum("sum", $dateFromDB, $dateToDB);
				generateOrdersPDF($indicatorId, $dateFrom, $dateTo, $sumOrders);
				break;
			case 3: // Verhältnis Angebote/Aufträge (KZ)
				$sumOffers = getOfferSum("sum", $dateFromDB, $dateToDB);
				$sumOrders = getOrdersSum("sum", $dateFromDB, $dateToDB);
				generateRelationOfferOrderPDF($indicatorId, $dateFrom, $dateTo, $sumOffers, $sumOrders);
				break;
			case 4: // Gesamtumsatz (KZ)
			case 6: // Gesamtumsatz (TAB)
				$totalRevenue = getTotalRevenue($indicatorId, 'pdf');
				generateTotalRevenuePDF($indicatorId, $dateFrom, $dateTo, $totalRevenue);
				break;
			case 5: // Mitarbeiterstatistik (TAB)
				$employees = getEmployeeStatistik($indicatorId, $dateDB, 'pdf');
				generateEmployeeStatistikPDF($indicatorId, $date, $employees);
				break;
			case 7: // Umsatz und Anzahl Bestellung pro Kunde (TAB)
				$turnoverAndQuantity = getTurnoverAndQuantityPerCustomer($indicatorId, 'pdf');
				generateTurnoverAndQuantityPerCustomerPDF($indicatorId, $dateFrom, $dateTo, $turnoverAndQuantity);
				break;
		}		
	}else {
		echo "sorry can't generate PDF.";
	}

function initPDF($indicatorId, $indiName, $indiType, $dateFrom, $dateTo) {
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Helvetica', 'B', 14);
	$pdf->Cell(0, 5, "$indiName ($indiType)");
	$pdf->Ln(10);
	$pdf->SetFont('Helvetica', '', 12);
	if($indicatorId==5) {
		$pdf->Cell(0, 5, "Zeitpunkt: ".$dateFrom);
	}else {
		$pdf->Cell(0, 5, "Zeitraum von: ".$dateFrom." - Zeitraum bis: ".$dateTo);
	}
	$pdf->Ln(10);
	return $pdf;
}


function generateOfferPDF($indicatorId, $dateFrom, $dateTo, $sumOffers) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$header = array($indiNameAndType[0] . " (".$indiNameAndType[1].")");
	$data = array(array($sumOffers));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);

	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateOrdersPDF($indicatorId, $dateFrom, $dateTo, $sumOrders) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	// todo add regex for replacing umlauts
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$header = array($indiNameAndType[0] . " (".$indiNameAndType[1].")");
	$data = array(array($sumOrders));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateRelationOfferOrderPDF($indicatorId, $dateFrom, $dateTo, $sumOffers, $sumOrders) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$header = array("Anzahl Angebote (KZ)", "Anzahl Aufträge (KZ)", "Verhältnis");
	$relation = round( (($sumOrders / $sumOffers) * 100), 2) . " %";
	$data = array(array($sumOffers, $sumOrders, $relation));
	$colWidth = array(50, 50, 40);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');	
}

function generateTotalRevenuePDF($indicatorId, $dateFrom, $dateTo, $totalRevenue) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$header = array($indiNameAndType[0] . " (".$indiNameAndType[1].")");
	$data = array(array(str_replace('.',',',$totalRevenue)." Euro"));
	$colWidth = array(50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateEmployeeStatistikPDF($indicatorId, $date, $employees) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $date, '');
	
	$header = array("Abteilung", "Anz. MA");
	$data = $employees;
	$colWidth = array(50, 50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$date.'.pdf';
	$pdf->Output($filename, 'D');
}

function generateTurnoverAndQuantityPerCustomerPDF($indicatorId, $dateFrom, $dateTo, $turnoverAndQuantity) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$header = array("Vorname", "Nachname", "Anz. Bestellungen", "Umsatz");
	$data = $turnoverAndQuantity; // todo iterate and str_replace the umsatz and add euro
	$colWidth = array(40, 40, 50, 50);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}


?>