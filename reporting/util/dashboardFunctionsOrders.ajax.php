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
	$sumMonth = getOrdersSum("sumMonth", getDateFrom($currentMonth."-".$currentYear), getDateTo($currentMonth."-".$currentYear));
		
	// 3. get value for current quarter
	if($currentQuarter == 1) { $startMonth = 1; $endMonth = 3; }
	else if($currentQuarter == 2) { $startMonth = 4; $endMonth = 6; }
	else if($currentQuarter == 3) { $startMonth = 7; $endMonth = 9;	}
	else { $startMonth = 10; $endMonth = 12; }
	$sumQuarter = getOrdersSum("sumQuarter", getDateFrom($startMonth."-".$currentYear), getDateTo($endMonth."-".$currentYear));
			
	// 4. get value for current year
	$sumYear = getOrdersSum("sumYear", getDateFrom("1-".$currentYear), getDateTo("12-".$currentYear));

	// 5. json object vor layout
	$labels = array(getMonthShortName($currentMonth).' '.$currentYear, $currentQuarter.'.Q. '.$currentYear, $currentYear);
	$data = array($sumMonth, $sumQuarter, $sumYear);
	$jsonOrders = array(
		'labels' => $labels,
		'datasets' => array(
			0 => array(
				'fillColor' => 'rgba(220,220,220,0.5)',
				'strokeColor' => 'rgba(220,220,220,1)',
				'data' => $data
			)
		)
	);
	
	echo json_encode($jsonOrders);
?>