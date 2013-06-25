<?php
function displayInvoiceSearchBar(){
	echo "
		<table>
			<tr>
				<form method=\"POST\" action=\"{$_SERVER["PHP_SELF"]}?content=RechnungErstellen\">
				<td>Kundennummer / Name:</td>
				<td><input type=\"text\" name=\"search\"></td>
				<td><input type=\"submit\" name=\"searchButton\" value=\"suchen\">
				</form>
			</tr>
			<tr>
				<td colspan=\"3\">Nach \"Order\" suchen um alle Angebote zu sehen!</td>
			</tr>
		</table>";
}

function findInvoices($pCriteria, $display){
	$check = substr($pCriteria,0,5);
	//echo $check;

	if($check == "order" | $check == "Order"){
		$query = "SELECT orders.id, orders.number, orders.date, offer.fk_customer_id
			FROM orders
			JOIN offer ON offer.fk_order_id=orders.id 
			JOIN person ON person.id=offer.fk_customer_id 
			WHERE (orders.number LIKE '$check%')
			ORDER BY offer.number DESC";
	}
	else{
		$query = "SELECT orders.id, orders.number, orders.date, offer.fk_customer_id
			FROM orders
			JOIN offer ON offer.fk_order_id=orders.id 
			JOIN person ON person.id=offer.fk_customer_id 
			WHERE (person.id = '$pCriteria'	 OR person.lastname = '$pCriteria')
			ORDER BY offer.number DESC";
	}

	//echo $query;
	//echo "<br /><br />" . substr($pCriteria, 0,5);
	//echo $query;
	$result = mysql_query($query);

	$count = mysql_num_rows($result);
		
	if($display == true){
		if($count == 0)
			echo "Keine Auftr&auml;ge gefunden!";

		if($count>0)
			displayInvoiceList($result);
	}
	else
		return $result;
}
/*
function findInvoices($pCritera) {
	$query = "SELECT number, date 
		FROM orders
		WHERE id = '$pCritera'";
	$result = mysql_query($query);
	return $result;
}*/

function displayInvoiceList($pData){
	echo "<br /><fieldset id=\"invoiceList\">
		<legend>Auftr&auml;ge</legend>
			<div id\"Auftraege\"><br />";
	
	echo "
		<table id=\"Auftraege\" rules=\"rows\">
		<thead>
			<tr>
				<td>Auftrags-ID</td>
				<td>&nbsp;&nbsp;&nbsp;Datum</td>
				<td>&nbsp;&nbsp;Kundennummer</td>
				<td>Gesamt-Preis</td>
				<td>Rechnung Erstellen</td>
			</tr>
		</thead>
		";	

	echo "<form method=\"POST\" action=\"{$_SERVER['PHP_SELF']}?content=RechnungErstellen&action=createPDF\">
		";
	echo "<tbody>";
		while($row = mysql_fetch_assoc($pData)){
		echo "<tr>
				<td>{$row['number']}</td>
				<td>&nbsp;&nbsp;&nbsp;{$row['date']}</td>
				<td>&nbsp;&nbsp;{$row['fk_customer_id']}</td>
				<td>";

				$offerID = getOfferIDbyOrderID($row['id']);

				$price = calulateOrderPrice($offerID);
				printf("€ %-20.2f", $price);
		echo   "</td>";

		echo "<td>";
				//if(checkInvoiceButton($row['number'])) {
				//	echo "<input type='hidden' name='pushedButton' value='showPDF'/>";
				//	echo "<input type=\"submit\" name=\"showPDF_{$row['id']}\" value=\"PDF anzeigen\"/>";
				//}else {
				//	echo "<input type='hidden' name='pushedButton' value='generateInvoice'/>";
					echo "<input type=\"submit\" name=\"generateInvoice_{$row['id']}\" value=\"Rechnung erstellen\"/>";
				//}
		echo "</td>";

		echo "</td>
			</tr>
		";
		//echo "<br /> <br />$expireDate > $currentDate";	
		}	
	echo "</tbody>";

	echo "</form></table></div>
	</fieldset>";
	
	}


	function getOfferIDbyOrderID($orderID){
	$query = "
			select offer.id from offer join orders on offer.fk_order_id=orders.id
			where orders.id = $orderID
			";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$ID = $row[0];
		return $ID;

	}

	function saveInvoiceToDatabase($createID){
		$curYear = date("Y");

		$businessRecNr = "AR" . $createID;
		$sumGrossPrice = 0;
		$sumNet = 0;
		$sumTax = 0;
		$taxRateId = 2;
		$taxTypeId = getTaxTypeId("ust");
		
		// get all articles for order with quantity
		$articleList = findArticlesWithQuantityForOrder(substr($createID, 6, strrpos($createID, "-")-6));
		
		foreach($articleList as $articleId => $quantity) {
			$article = findArticleById($articleId, false);
			while($row = mysql_fetch_assoc($article)){
				$grossPrice = ($row['selling_price'] * $quantity);
				
				if($row['tax_rate']==10) { (float)$ust = $grossPrice / 11; }
				else if($row['tax_rate']==20) { (float)$ust = $grossPrice / 6; }

				$net = $grossPrice - $ust;
				
				$sumGrossPrice += $grossPrice;
				$sumNet += $net;
				$sumTax += $ust;				
				
				//$taxRateId = getTaxRateId($row['tax_rate']);
			}
		}

		
				
		
		$queryInvoice = "
			INSERT INTO invoice(fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber)
			VALUES ($taxTypeId,$taxRateId,now(),$sumGrossPrice,$sumNet,$sumTax,'$businessRecNr')";

		mysql_query($queryInvoice);
		//echo $queryInvoice;
		
		$lastID = mysql_insert_id();

		$orderID = substr($createID, 6, strrpos($createID, "-")-6);
		
		return $orderID;
	}

	function getTaxTypeId($type) {
		$query = "SELECT id FROM tax_type WHERE type='$type'";
		$result = mysql_query($query);
	
		if ($result && mysql_num_rows($result)) {
			while($z = mysql_fetch_assoc($result)){
				return $z['id'];
			}
		}else {
			showErrorMsg(mysql_errno(), $query);
		}
	}

	function getTaxRateId($rate) {
		$query = "SELECT id FROM tax_rate WHERE rate='$rate'";
		$result = mysql_query($query);
	
		if($result && mysql_num_rows($result)) {
			while($z = mysql_fetch_assoc($result)) {
				return $z['id'];
			}
		}/*else {
			showErrorMsg(mysql_error(), $query);
		}*/
	}

	function checkInvoiceButton($orderNumber){
		$query = "
			SELECT businessRecordNumber
			FROM invoice where businessRecordNumber = 'AR".$orderNumber."'";

		$result = mysql_query($query);
		
		if(mysql_num_rows($result) > 0) {
			return true;
		}else {
			return false;
		}
/*		while($row = mysql_fetch_row($result)){
			$check = substr($row[0], 8, strrpos($check, "-"));
		}*/
	}

?>