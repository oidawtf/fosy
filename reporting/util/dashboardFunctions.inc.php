<?php
	
	function getOfferSum($type, $dateFrom, $dateTo) {
		$query = "SELECT count(*) AS ".$type." FROM offer WHERE date BETWEEN '".$dateFrom."' AND '".$dateTo."'";
		$result = mysql_query($query);
		if($result && mysql_num_rows($result)) {
			while($row = mysql_fetch_assoc($result)) {
				// 2a., 3a., 4a. return result
				return $row[$type];
			}
		}else {
			showErrorMsg(mysql_errno(), $query);
		}
	}
	
	function getOrdersSum($type, $dateFrom, $dateTo) {
		$query = "SELECT count(*) AS ".$type." FROM orders WHERE date BETWEEN '".$dateFrom."' AND '".$dateTo."'";
		$result = mysql_query($query);
		if($result && mysql_num_rows($result)) {
			while($row = mysql_fetch_assoc($result)) {
				// 2a., 3a., 4a. return result
				return $row[$type];
			}
		}else {
			showErrorMsg(mysql_errno(), $query);
		}
	}

?>