<?php

function getIndicators() {
	$query = "SELECT i.id, i.name FROM indicator i join indicator_type it on i.fk_indicator_type_id = it.id where it.type='KZ'";
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

?>