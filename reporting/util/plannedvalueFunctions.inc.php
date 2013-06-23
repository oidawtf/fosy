<?php

function getIndicators() {
	$query = "SELECT i.id, i.name, it.type FROM indicator i JOIN indicator_type it ON i.fk_indicator_type_id = it.id WHERE it.type='KZ'";
	$result = mysql_query($query);

	$indicators = array();

	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($indicators, $row);
		}
	}else {	
		showErrorMsg(mysql_error(), $query);
	}

	return $indicators;
}

function getIndicatorsWithLess3Values() {
	$query = "SELECT i.id, i.name FROM indicator i JOIN indicator_type it ON i.fk_indicator_type_id = it.id LEFT JOIN plannedvalue pv ON i.id = pv.fk_indicator_id WHERE it.type='KZ' GROUP BY i.name HAVING count(pv.id) < 3";
	$result = mysql_query($query);

	$indicators = array();

	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($indicators, $row);
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}

	return $indicators;
}

function getPeriods() {
	$query = "SELECT id, value FROM period";
	$result = mysql_query($query);

	$periods = array();
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($periods, $row);
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}

	return $periods;
}

function getPlannedvalueTypes() {
	$query = "SELECT id, type FROM plannedvalue_type";
	$result = mysql_query($query);
	$plannedvalueTypes = array();

	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($plannedvalueTypes, $row);
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}

	return $plannedvalueTypes;
}

function savePlannedvalue($selectedIndicator, $selectedPeriod, $enteredValue, $selectedPlannedvalueType) {
	if(checkPlannedIndicator($selectedIndicator) && checkPeriod($selectedPeriod) && checkValue($enteredValue) && checkPlannedvalueType($selectedPlannedvalueType)) {
		$query = "INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ($selectedPeriod, $selectedIndicator, $selectedPlannedvalueType, '$enteredValue')";
		$result = mysql_query($query);

		if($result && mysql_affected_rows()) {
			redirect("addPlannedvalueSuccess");
		}else {
			showErrorMsg(mysql_error(), $query);
		}
	}else {
		echo "never see this msg in the browser! only needed, if anybody called the form outside.";
	}
}

function updatePlannedvalue($pvID, $wert, $plannedvalueType) {
	if(checkValue($wert) && checkPlannedvalueType($plannedvalueType)) {

		$query = "UPDATE plannedvalue SET value='".$wert."', fk_plannedvalue_type_id =".$plannedvalueType." WHERE id=".$pvID;

		$result = mysql_query($query);

		if($result) {
			redirect("editPlannedvalueSuccess");
		}else {
			showErrorMsg(mysql_error(), $query);
		}
	}else {
		echo "never see this msg in the browser! only needed, if anybody called the form outside.";
	}
}

function deletePlannedvalue($pvID) {
	$query = "DELETE FROM plannedvalue WHERE id=".$pvID;

	$result = mysql_query($query);

	if($result && mysql_affected_rows()) {
		redirect("deletePlannedvalueSuccess");
	}else {
		showErrorMsg(mysql_error(), $query);
	}
}

function getPlannedvalue($pvID) {
	$query = "SELECT i.name AS iName, i.id AS iID, p.value AS pValue, p.id AS pID, pv.value AS pvValue, pv.id AS pvID, pvt.id AS pvtID, pvt.type AS pvtType FROM plannedvalue pv JOIN indicator i ON pv.fk_indicator_id = i.id JOIN period p ON pv.fk_period_id=p.id JOIN plannedvalue_type pvt ON pv.fk_plannedvalue_type_id=pvt.id WHERE pv.id=".$pvID;

	$result = mysql_query($query);


	$plannedvalue = array();

	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($plannedvalue, $row);
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}

	return $plannedvalue;	
}

function getPlannedvalueByPeriod($indicatorID, $period) {
	$query = "SELECT pv.value AS pvValue FROM plannedvalue pv JOIN indicator i ON pv.fk_indicator_id = i.id JOIN period p ON pv.fk_period_id=p.id JOIN plannedvalue_type pvt ON pv.fk_plannedvalue_type_id=pvt.id WHERE i.id=".$indicatorID." AND p.value='".$period."'";

	$result = mysql_query($query);

	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			$plannedvalue = $row['pvValue'];
		}
	}else {
		//showErrorMsg(mysql_error(), $query);
		return -1;
	}

	return $plannedvalue;	
}


function generatePlannedActualComparison($planIndicatorId, $period, $dateFromDB, $dateToDB) {	

	switch($planIndicatorId) {
		case 1: // Anzahl Angebote (KZ) 
			$result = getPlannedActualComparisonOffers($planIndicatorId, $period, $dateFromDB, $dateToDB, 'html');
			break;
		case 2: // Anzahl Aufträge (KZ)
			$result = getPlannedActualComparisonOrders($planIndicatorId, $period, $dateFromDB, $dateToDB, 'html');
			break;
		case 3: // Verhältnis Angebote/Aufträge (KZ)
			$result = getPlanedActualComparisonRelationOfferOrder($planIndicatorId, $period, $dateFromDB, $dateToDB, 'html');
			break;
		case 4: // Gesamtumsatz (KZ)
			$result = getPlannedActualComparisonTotalRevenue($planIndicatorId, $period, $dateFromDB, $dateToDB, 'html');
			break;
	}

	return $result;	
}

function getPlannedActualComparisonOffers($indicatorId, $period, $dateFromDB, $dateToDB, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$plannedvalue = getPlannedvalueByPeriod($indicatorId, $period);
	$actualvalue = getOfferSum("sum", $dateFromDB, $dateToDB);

	if( ($plannedvalue != -1) && ($actualvalue != -1) ) {
		$relation = round( (($actualvalue / $plannedvalue) * 100), 2);

		if($htmlPDF == 'html') {
			return getPlannedActualComparisonResult($indiNameAndType, $period, $dateFromDB, $dateToDB, $plannedvalue, $actualvalue, $relation, '');
		}else {
			return array($plannedvalue, $actualvalue, $relation);
		}

	}else {
		return -1;
	}
}

function getPlannedActualComparisonOrders($indicatorId, $period, $dateFromDB, $dateToDB, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$plannedvalue = getPlannedvalueByPeriod($indicatorId, $period);
	$actualvalue = getOrdersSum("sum", $dateFromDB, $dateToDB);

	if( ($plannedvalue != -1) && ($actualvalue != -1)) {
		$relation = round( (($actualvalue / $plannedvalue) * 100), 2);

		if($htmlPDF == 'html') {
			return getPlannedActualComparisonResult($indiNameAndType, $period, $dateFromDB, $dateToDB, $plannedvalue, $actualvalue, $relation, '');
		}else {
			return array($plannedvalue, $actualvalue, $relation);
		}

	}else {
		return -1;
	}
}

function getPlanedActualComparisonRelationOfferOrder($indicatorId, $period, $dateFromDB, $dateToDB, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$plannedvalue = getPlannedvalueByPeriod($indicatorId, $period);

	$offerSum = getOfferSum("sum", $dateFromDB, $dateToDB);
	$ordersSum = getOrdersSum("sum", $dateFromDB, $dateToDB);
	$actualvalue = round( (($ordersSum / $offerSum) * 100), 2);


	if( ($plannedvalue != -1) && ($actualvalue != -1)) {
		$relation = round( (($actualvalue / $plannedvalue) * 100), 2);

		if($htmlPDF == 'html') {
			return getPlannedActualComparisonResult($indiNameAndType, $period, $dateFromDB, $dateToDB, $plannedvalue, $actualvalue, $relation, '%');
		} else {
			return array($plannedvalue, $actualvalue, $relation);
		}

	}else {
		return -1;
	}
}

function getPlannedActualComparisonTotalRevenue($indicatorId, $period, $dateFromDB, $dateToDB, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$plannedvalue = getPlannedvalueByPeriod($indicatorId, $period);
	$actualvalue = getTotalRevenue($indicatorId, $dateFromDB, $dateToDB, 'pdf');

	if( ($plannedvalue != -1) && ($actualvalue != -1)) {
		$relation = round( (($actualvalue / $plannedvalue) * 100), 2);

		if($htmlPDF == 'html') {
			return getPlannedActualComparisonResult($indiNameAndType, $period, $dateFromDB, $dateToDB, $plannedvalue, $actualvalue, $relation, '€');
		}else {
			return array($plannedvalue, $actualvalue, $relation);
		}

	}else {
		return -1;
	}
}

function getPlannedActualComparisonResult($indiNameAndType, $period, $dateFromDB, $dateToDB, $plannedvalue, $actualvalue, $relation, $type) {
	$htmlResult = "<fieldset class='ui-widget ui-widget-content-white ui-corner-all'>
		<legend>".$indiNameAndType[0]." (".$indiNameAndType[1].")</legend>
		<div>Zeitraum: ".$period."</div>
		<div>Datum: ".formatDateForOutput($dateFromDB)." - ".formatDateForOutput($dateToDB)."</div>
		<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
			<thead class='ui-widget-header ui-corner-all'>
				<tr><th>Plan-Wert</th><th>Ist-Wert</th><th>Verhältnis</th></tr>
			</thead>
			<tbody>
				<tr>
					<td class='right'>".$plannedvalue." ".$type."</td>
					<td class='right'>".$actualvalue." ".$type."</td>
					<td class='right'>".$relation." %</td>
				</tr>
			</tbody>
		</table>
	</fieldset>";

	return $htmlResult;
}

/* CHECK Methods */
function checkPlannedIndicator($selectedIndicator) {
	if($selectedIndicator <= 0) { return false; }
	else { return true; }
}

function checkPeriod($selectedPeriod) {
	if($selectedPeriod <= 0) { return false; }
	else { return true; }
}

function checkValue($enteredValue) {
	if($enteredValue=="") { return false; }
	else { return true; }
}

function checkPlannedvalueType($selectedPlannedvalueType) {
	if($selectedPlannedvalueType <= 0) { return false; }
	else { return true; }
}

function checkPlanWhichTime($selectedWhichTime) {
	if($selectedWhichTime <= 0) { return false; }
	else { return true; }
}

function checkMonthSelected($month) {
	if($month <= 0) { return false; }
	else { return true; }
} 

function checkQuarterSelected($quarter) {
	if($quarter <= 0) { return false; }
	else { return true; }
}

function checkYearSelected($year) {
	if($year <= 0) { return false; }
	else { return true; }
}
?>