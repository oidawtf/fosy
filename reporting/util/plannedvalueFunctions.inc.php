<?php

function getIndicators() {
	$query = "SELECT i.id, i.name FROM indicator i JOIN indicator_type it ON i.fk_indicator_type_id = it.id WHERE it.type='KZ'";
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

function savePlannedvalue($selectedIndicator, $selectedPeriod, $enteredValue, $selectedPlannedvalueType) {
	if(checkIndicator($selectedIndicator) && checkPeriod($selectedPeriod) && checkValue($enteredValue) && checkPlannedvalueType($selectedPlannedvalueType)) {
				
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
?>