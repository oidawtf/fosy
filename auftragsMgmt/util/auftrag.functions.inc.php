<?php
function displayOfferSearchBar(){
	echo "
		<table>
			<tr>
				<form method=\"POST\" action=\"{$_SERVER["PHP_SELF"]}?content=AuftragErstellen\">
				<td>Kundennummer / Name:</td>
				<td><input type=\"text\" name=\"search\"></td>
				<td><input type=\"submit\" name=\"searchButton\" value=\"suchen\">
				</form>
			</tr>
			<tr>
				<td colspan=\"3\">Nach \"Offer\" suchen um alle Angebote zu sehen!</td>
			</tr>
		</table>";
}

function findOffers($pCriteria, $display){
	$check = substr($pCriteria,0,5);
	//echo $check;
	if($check == "Offer" | $check == "offer"){
		$query = "SELECT offer.id, offer.fk_customer_id, offer.valid_until, offer.number
			FROM offer
			WHERE(offer.number LIKE '$pCriteria%')
			ORDER BY offer.number DESC";
	}
	else{
		$query = "SELECT offer.id, offer.fk_customer_id, offer.valid_until, offer.number, person.lastname
			FROM offer
			JOIN person ON ( person.id ) 
			WHERE(offer.fk_customer_id = person.id
			AND (person.id = '$pCriteria' OR person.lastname = '$pCriteria')
			AND (now() < offer.valid_until))
			ORDER BY offer.number DESC";
			//asd
	}
	
   // echo $query;
	//echo "<br /><br />" . substr($pCriteria, 0,5);
	
	$result = mysql_query($query);

	$count = mysql_num_rows($result);
		
	if($display == true){
		if($count == 0)
			echo "Keine Angebote gefunden!";

		if($count>0)
			displayOfferList($result);
	}
	else
		return $result;
}

function findOrders($pCritera) {
	$query = "SELECT number, date 
		FROM orders
		WHERE id = '$pCritera'";
	$result = mysql_query($query);
	return $result;
}

function displayOfferList($pData){
	echo "<br /><fieldset id=\"articleList\">
		<legend>Angebote</legend>
			<div id=\"Angebote\"><br />";
	
	echo "
		<table id=\"artikelDatenTable\" rules=\"rows\">
		<thead>
			<tr>
				<td>Angebots-ID</td>
				<td>&nbsp;&nbsp;Kundennummer</td>";
			$tmpRow = mysql_fetch_assoc($pData);
			if(isset($tmpRow['lastname'])){
				echo "<td>Name</td>";
			}

		echo "
				<td>&nbsp;Gesamt-Preis</td>
				<td>&nbsp;G&uuml;ltig bis</td>
			</tr>
		</thead>
		";	

	echo "<FORM METHOD=\"POST\" action=\"{$_SERVER['PHP_SELF']}?content=AuftragErstellen&action=createPDF\">
		";
	echo "<tbody>";
		while($row = mysql_fetch_assoc($pData)){
		echo "<tr>
				<td>{$row['number']}</td>
				<td>&nbsp;&nbsp;{$row['fk_customer_id']}</td>";
			if(isset($row['lastname'])){
				echo "<td>{$row['lastname']}</td>";
			}

		echo "
				<td>";
				$price = calulateOrderPrice($row['id']);
				printf("€ %-20.2f", $price);
		echo   "</td>
				<td>&nbsp;{$row['valid_until']}</td>
				<td>";
				
				$currentDate = date('Y-n-j');
			//	echo $currentDate;
				$expireDate = $row['valid_until'];
				
				$currentDate = strtotime($currentDate);
				$expireDate = strtotime($expireDate);
				//echo "$expireDate > $currentDate";
				if($expireDate > $currentDate){
					echo "<input type=\"submit\" name=\"generateOrder_{$row['id']}\" value=\"Auftrag erstellen\"/>";
				}
		
		echo "</td>
			</tr>
		";
		//echo "<br /> <br />$expireDate > $currentDate";	
		}	
	echo "</tbody>";

	echo"</form></table></div>
	</fieldset>";
	
	}

	function calulateOrderPrice($offerID){
	
	$query ="
			select sum(oa.count * a.selling_price) from offer off 
			join offer_article oa on oa.fk_offer_id = off.id
			join article a on oa.fk_article_id = a.id
			where off.id = $offerID
			";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$price = $row[0];
		return $price;

	}

	function saveOrderToDatabase($createID){
		$curYear = date("Y");

		$maxID = mysql_query("SELECT MAX(id) FROM orders");

		while($row = mysql_fetch_row($maxID)){
			$lastOrderID = $row[0]+1;
		}
		//echo $lastOrderID . "<br /><br />##########<br /><br /><br />";
		$orderNumber = "order-$lastOrderID-$curYear";
		//echo "<br /><br />##########<br /><br /><br />order-$lastOrderID-$curYear";

		$queryOrders = "
			INSERT INTO orders(number, date)
			VALUES ('$orderNumber', now())";

		mysql_query($queryOrders);
		
		$lastID = mysql_insert_id();

		$upateOfferQuery = 
		"
			UPDATE offer SET fk_order_id=$lastID
			where id = $createID
		";
		
		mysql_query($upateOfferQuery);

		return $lastOrderID;
	}

	function findCustomerId($orderId) {
		$query = "select offer.fk_customer_id from offer where fk_order_id=".$orderId;
		
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		return $row[0];
	}
	
	function findArticlesWithQuantityForOrder($orderId) {
		$query = "select oa.fk_article_id as id, oa.count as count from offer_article oa join offer o on oa.fk_offer_id = o.id join orders ors on o.fk_order_id = ors.id where ors.id=".$orderId;
		
		$result = mysql_query($query);
		
		$resultArray = array();
		
		while($row = mysql_fetch_assoc($result)) {
			$id = $row['id'];
			$count = $row['count'];
			$resultArray[$id] = $count;
		}
		
		return $resultArray;
	}
	
	function findDeliveryAddressForOrder($orderId) {
		$query = "select d.street, d.housenumber, d.stiege, d.doornumber, d.city, d.zip, d.country from delivery d join offer o on o.fk_delivery_id = d.id where o.fk_order_id =".$orderId;
		
		$result = mysql_query($query);
		
		$resultArray = array();
		
		while($row = mysql_fetch_assoc($result)) {
			$resultArray['strasse'] = $row['street'];
			$resultArray['hausnummer'] = $row['housenumber'];
			if(!isset($row['stiege'])) { $resultArray['stiege'] = ""; }
			else { $resultArray['stiege'] = $row['stiege']; }
			if(!isset($row['doornumber'])) { $resultArray['doornum'] = ""; }
			else { $resultArray['doornum'] = $row['doornumber']; }
			$resultArray['zip'] = $row['zip'];
			$resultArray['stadt'] = $row['city'];
			$resultArray['land'] = $row['country'];
		}
		
		return $resultArray;
	}

	function findMontageByOrder($orderId) {
		$query = "select d.assambly from delivery d join offer o on o.fk_delivery_id = d.id where o.fk_order_id=".$orderId;
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		
		return $row[0];
	}
?>