<?php

function getAllIndicators() {
	$query = "SELECT i.id, i.name, it.type FROM indicator i JOIN indicator_type it ON i.fk_indicator_type_id = it.id";
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

function generateReport($indicatorId, $dateFrom, $dateTo, $date) {
	if(isset($date)) { $dateDB = formatDateForDatabase($date); }
	if(isset($dateFrom)) { $dateFromDB = formatDateForDatabase($dateFrom); }
	if(isset($dateTo)) { $dateToDB = formatDateForDatabase($dateTo); }
	
	switch($indicatorId) {
		case 1: // Anzahl Angebote (KZ)
			$result = getOffers($indicatorId, $dateFromDB, $dateToDB);
			break;
		case 2: // Anzahl Aufträge (KZ)
			$result = getOrders($indicatorId, $dateFromDB, $dateToDB);
			break;
		case 3: // Verhältnis Angebote/Aufträge (KZ)
			$result = getRelationOfferOrder($indicatorId, $dateFromDB, $dateToDB);
			break;
		case 4: // Gesamtumsatz (KZ)
		case 6: // Gesamtumsatz (TAB)
			$result = getTotalRevenue($indicatorId, 'html');
			break;
		case 5: // Mitarbeiterstatistik (TAB)
			$result = getEmployeeStatistik($indicatorId, $dateDB, 'html');
			break;
		case 7: // Umsatz und Anzahl Bestellung pro Kunde (TAB)
			$result = getTurnoverAndQuantityPerCustomer($indicatorId, 'html');
			break;
	}
	
	return $result;
}

function getOffers($indicatorId, $dateFromDB, $dateToDB) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	
	$htmlResult = "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
			<thead class='ui-widget-header ui-corner-all'>
				<tr><th>".$indiNameAndType[0]." (".$indiNameAndType[1].")</th></tr>
			</thead>
			<tbody>
				<tr><td class='right'>".getOfferSum("sum", $dateFromDB, $dateToDB)."</td></tr>
			</tbody>
		</table>";
	
	return $htmlResult; // todo what if htmlresult empty?
}

function getOrders($indicatorId, $dateFromDB, $dateToDB) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	
	$htmlResult = "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
			<thead class='ui-widget-header ui-corner-all'>
				<tr><th>".$indiNameAndType[0]." (".$indiNameAndType[1].")</th></tr>
			</thead>
			<tbody>
				<tr><td class='right'>".getOrdersSum("sum", $dateFromDB, $dateToDB)."</td></tr>
			</tbody>
		</table>";
	
	return $htmlResult; // todo what if htmlresult empty?
}

function getRelationOfferOrder($indicatorId, $dateFromDB, $dateToDB) {
	$indiNameAndTypeOffer = getIndicatorNameAndType(1); // Anzahl Angebote
	$indiNameAndTypeOrders = getIndicatorNameAndType(2); // Anzahl Auftraege
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	
	$offerSum = getOfferSum("sum", $dateFromDB, $dateToDB);
	$ordersSum = getOrdersSum("sum", $dateFromDB, $dateToDB);
	$relation = round( (($ordersSum / $offerSum) * 100), 2);
	
	$htmlResult = "
		<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
			<thead class='ui-widget-header ui-corner-all'>
				<tr>
					<th>".$indiNameAndTypeOffer[0]." (".$indiNameAndTypeOffer[1].")</th>
					<th>".$indiNameAndTypeOrders[0]." (".$indiNameAndTypeOrders[1].")</th>
					<th>".$indiNameAndType[0]." (".$indiNameAndType[1].")</th></tr>
			</thead>
			<tbody>
				<tr>
					<td class='right'>".$offerSum."</td>
					<td class='right'>".$ordersSum."</td>
					<td class='right'>".$relation." %</td>
				</tr>
			</tbody>
		</table>";
	
	return $htmlResult; // todo what if htmlresult empty?
}

function getTotalRevenue($indicatorId, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	
	$query = "SELECT sum(gross_price) FROM invoice i JOIN tax_type tt ON i.fk_tax_type_id = tt.id WHERE tt.type = 'ust'
";
	$result = mysql_query($query);
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_row($result)) {
			$totalRevenue = $row[0];
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}
	
	if($htmlPDF=='html') {
		// todo format the output value
		$htmlResult = "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
				<thead class='ui-widget-header ui-corner-all'>
					<tr><th>".$indiNameAndType[0]." (".$indiNameAndType[1].")</th></tr>
				</thead>
				<tbody>
					<tr><td class='right'>".str_replace(".", ",", $totalRevenue)." €</td></tr>
				</tbody>
			</table>";
	
		return $htmlResult; // todo what if htmlresult empty?
	}else {
		return $totalRevenue;
	}
}

function getEmployeeStatistik($indicatorId, $dateDB, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	$query = "SELECT d.name AS departmentName, count(name) AS anzahlMA FROM person p JOIN department d ON p.fk_department_id = d.id WHERE p.is_employee=1 AND hiredate < '".$dateDB."' GROUP BY d.name ORDER BY d.id";
	$result = mysql_query($query);
	
	if($result && mysql_num_rows($result)) {
		$htmlResult = "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
				<thead class='ui-widget-header ui-corner-all'>
					<tr>
						<th>".$indiNameAndType[0]." (".$indiNameAndType[1].")</th>
						<th>Anzahl MA</th>
					</tr>
				</thead><tbody>";
		$i = 0; // counter for layout
		if($htmlPDF=='html') {
			while($row = mysql_fetch_assoc($result)) {
				$htmlResult .= "
					<tr class='cell".($i%2)."'>
						<td>".$row['departmentName']."</td><td class='center'>".$row['anzahlMA']."</td>
					</tr>";
				$i++;
			}
		}else {
			$returnResult = array();
			while($row = mysql_fetch_row($result)) {
				array_push($returnResult, $row);
			}
			return $returnResult;
		}
		
		$htmlResult .= "</tbody></table>";
	}else {
		showErrorMsg(mysql_errno(), $query);
	}
	
	return $htmlResult; // todo what if htmlresult empty?
	
}

function getTurnoverAndQuantityPerCustomer($indicatorId, $htmlPDF) {
	$indiNameAndType = getIndicatorNameAndType($indicatorId);
	
	$query = "SELECT p.firstname, p.lastname, count(ors.id) AS AnzOrders, sum(i.gross_price) AS Umsatz FROM person p
JOIN offer of ON p.id = of.fk_customer_id JOIN orders ors ON of.fk_order_id = ors.id JOIN invoice i ON ors.number = i.businessRecordNumber WHERE p.is_customer = 1 GROUP BY p.id";

	$result = mysql_query($query);
	if($result && mysql_num_rows($result)) {
		$htmlResult = "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'>
				<thead class='ui-widget-header ui-corner-all'>
					<tr><th>Vorname</th><th>Nachname</th><th>Anz. Bestellungen</th><th>Umsatz</th></tr>
				</thead><tbody>";
		$i = 0; // counter for layout
		if($htmlPDF=='html') {
			while($row = mysql_fetch_assoc($result)) {
				$htmlResult .= "
					<tr class='cell".($i%2)."'>
						<td>".$row['firstname']."</td>
						<td>".$row['lastname']."</td>
						<td class='center'>".$row['AnzOrders']."</td>
							<td class='right'>".str_replace(".", ",", $row['Umsatz'])." €</td>
					</tr>";
				$i++;
			}
		}else {
			$returnResult = array();
			while($row = mysql_fetch_row($result)) {
				array_push($returnResult, $row);
			}
			return $returnResult;
		}
		
		$htmlResult .= "</tbody></table>";
	}else {
		showErrorMsg(mysql_errno(), $query);
	}
	
	return $htmlResult; // todo what if htmlresult empty?
}

function getIndicatorNameAndType($indicatorId) {
	$query = "SELECT i.name AS name, it.type AS type FROM indicator i JOIN indicator_type it ON i.fk_indicator_type_id = it.id WHERE i.id=".$indicatorId;
	$result = mysql_query($query);
	$indiNameAndType = array();
	if($result && mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			array_push($indiNameAndType, $row['name']);
			array_push($indiNameAndType, $row['type']);
		}
	}else {
		showErrorMsg(mysql_error(), $query);
	}
	
	return $indiNameAndType;
}

function checkFlexibleIndicator($selectedIndicator) {
	if($selectedIndicator <= 0) { return false; }
	else { return true; }
}



?>