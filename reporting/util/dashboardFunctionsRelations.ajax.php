<?php
	require("../../shared/authenticationController.php");
	require("dateFunctions.inc.php");
	require("dashboardFunctions.inc.php");
	require("db.inc.php");

	// 1. current month, current quarter, current year
	$currentMonth = date('n');
	$currentQuarter = floor(date('m')/3);
	$currentYear = date('Y');
	
	// 2. get value for current month
	$sumMonthOffer = getOfferSum("sumMonth", getDateFrom($currentMonth."-".$currentYear), getDateTo($currentMonth."-".$currentYear));
	$sumMonthOrder = getOrdersSum("sumMonth", getDateFrom($currentMonth."-".$currentYear), getDateTo($currentMonth."-".$currentYear));
	
	// 3. get value for current quarter
	if($currentQuarter == 1) { $startMonth = 1; $endMonth = 3; }
	else if($currentQuarter == 2) { $startMonth = 4; $endMonth = 6; }
	else if($currentQuarter == 3) { $startMonth = 7; $endMonth = 9;	}
	else { $startMonth = 10; $endMonth = 12; }
	$sumQuarterOffer = getOfferSum("sumQuarter", getDateFrom($startMonth."-".$currentYear), getDateTo($endMonth."-".$currentYear));
	$sumQuarterOrder = getOrdersSum("sumQuarter", getDateFrom($startMonth."-".$currentYear), getDateTo($endMonth."-".$currentYear));
			
	// 4. get value for current year
	$sumYearOffer = getOfferSum("sumYear", getDateFrom("1-".$currentYear), getDateTo("12-".$currentYear));
	$sumYearOrder = getOrdersSum("sumYear", getDateFrom("1-".$currentYear), getDateTo("12-".$currentYear));

	// 5. Relations
	$relationMonth = round( (($sumMonthOrder / $sumMonthOffer) * 100), 2);
	$relationQuarter = round( (($sumQuarterOrder / $sumQuarterOffer) * 100), 2);
	$relationYear = round( (($sumYearOrder / $sumYearOffer) * 100), 2);


	// 6. json object for layout	
	$labels = array(getMonthShortName($currentMonth).' '.$currentYear.' ('.$relationMonth.' %)', $currentQuarter.'.Q. '.$currentYear.' ('.$relationQuarter.' %)', $currentYear.' ('.$relationYear.' %)');
	$data0 = array($sumMonthOffer, $sumQuarterOffer, $sumYearOffer);
	$data1 = array($sumMonthOrder, $sumQuarterOrder, $sumYearOrder);
	$jsonRelation = array(
		'labels' => $labels,
		'datasets' => array(
			0 => array(
				'fillColor' => '#d0e5f5',
				'strokeColor' => '#4297d7',
				'data' => $data0
			),
			1 => array(
				'fillColor' => 'rgba(220,220,220,0.5)',
				'strokeColor' => 'rgba(220,220,220,1)',
				'data' => $data1
			)
		)
	);
	
	echo json_encode($jsonRelation);

?>