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
	require('../util/plannedvalueFunctions.inc.php');
	require('../util/dashboardFunctions.inc.php');
	require('../util/flexibleReportsFunctions.inc.php');
	require('../util/pdf.class.php');

	
	$indicatorId = $_GET['planIndicatorsSelect'];
	$period = $_GET['period'];
	$dateFromDB = $_GET['dateFromDB']; // yyyy-mm-dd
	$dateToDB = $_GET['dateToDB']; // yyyy-mm-dd
	
	
	if(checkPlannedIndicator($indicatorId) && (isset($period))) {
		$dataCorrect = true;
	}else {
		$dataCorrect = false;
	}
		
	if($dataCorrect) {	
		
		switch($indicatorId) {
			case 1: // Anzahl Angebote (KZ)
				$plannedActualComparisonOffers = getPlannedActualComparisonOffers($indicatorId, $period, $dateFromDB, $dateToDB, 'pdf');
				
				generatePlannedActualComparisonOfferPDF($indicatorId, formatDateForOutput($dateFromDB), formatDateForOutput($dateToDB), $plannedActualComparisonOffers);
				break;
			case 2: // Anzahl Aufträge (KZ)
				$plannedActualComparisonOrders = getPlannedActualComparisonOrders($indicatorId, $period, $dateFromDB, $dateToDB, 'pdf');
				generatePlannedActualComparisonOrdersPDF($indicatorId, formatDateForOutput($dateFromDB), formatDateForOutput($dateToDB), $plannedActualComparisonOrders);
				break;
			case 3: // Verhältnis Angebote/Aufträge (KZ)
				$plannedActualComparisonRelationOfferOrders = getPlanedActualComparisonRelationOfferOrder($indicatorId, $period, $dateFromDB, $dateToDB, 'pdf');
				
				generatePlannedActualComparisonRelationOfferOrderPDF($indicatorId, formatDateForOutput($dateFromDB), formatDateForOutput($dateToDB), $plannedActualComparisonRelationOfferOrders);
				break;
			case 4: // Gesamtumsatz (KZ)
				$plannedActualComparisonTotalRevenue = getPlannedActualComparisonTotalRevenue($indicatorId, $period, $dateFromDB, $dateToDB, 'pdf');
				
				generatePlannedActualComparisonTotalRevenuePDF($indicatorId, formatDateForOutput($dateFromDB), formatDateForOutput($dateToDB), $plannedActualComparisonTotalRevenue);
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
	$KZName = utf8_decode($indiName);
	$pdf->Cell(0, 5, "$KZName ($indiType)");
	$pdf->Ln(10);
	$pdf->SetFont('Helvetica', '', 12);
	$pdf->Cell(0, 5, "Zeitraum von: ".$dateFrom." - Zeitraum bis: ".$dateTo);
	$pdf->Ln(10);
	return $pdf;
}


function generatePlannedActualComparisonOfferPDF($indicatorId, $dateFrom, $dateTo, $plannedActualComparisonOffers) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$str = "Verhältnis in %";
	$header = array("Plan-Wert", "Ist-Wert", $str);
	$data = array($plannedActualComparisonOffers); // todo add datatype to values
	$colWidth = array(40, 40, 40);
	$pdf->Table($colWidth, $header, $data);

	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generatePlannedActualComparisonOrdersPDF($indicatorId, $dateFrom, $dateTo, $plannedActualComparisonOrders) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	// todo add regex for replacing umlauts
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$str = "Verhältnis in %";
	$header = array("Plan-Wert", "Ist-Wert", $str);
	$data = array($plannedActualComparisonOrders); // todo add datatype to values
	$colWidth = array(40, 40, 40);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}

function generatePlannedActualComparisonRelationOfferOrderPDF($indicatorId, $dateFrom, $dateTo, $plannedActualComparisonRelationOfferOrders) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$str = "Verhältnis in %";
	$header = array("Plan-Wert", "Ist-Wert", $str);
	$data = array($plannedActualComparisonRelationOfferOrders);
	$colWidth = array(40, 50, 40);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');	
}

function generatePlannedActualComparisonTotalRevenuePDF($indicatorId, $dateFrom, $dateTo, $plannedActualComparisonTotalRevenue) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$pdf = initPDF($indicatorId, $indiNameAndType[0], $indiNameAndType[1], $dateFrom, $dateTo);
	
	$str = "Verhältnis in %";
	$header = array("Plan-Wert", "Ist-Wert", $str);
	$data = array($plannedActualComparisonTotalRevenue);
	$colWidth = array(40, 40, 40);
	$pdf->Table($colWidth, $header, $data);
	
	$filename = $indiNameAndType[0].'_'.$dateFrom.'-'.$dateTo.'.pdf';
	$pdf->Output($filename, 'D');
}


?>