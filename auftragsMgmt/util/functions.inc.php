<?php
	include "auftrag.functions.inc.php";
	function findPerson($pCritera, $pDisplay){
		$query = "SELECT id, firstname, lastname, city, street, housenumber
			FROM person
			WHERE is_customer=1
			AND (lastname = '$pCritera' OR id = '$pCritera')";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);

/*
		while($row = mysql_fetch_assoc($result)){
			$_SESSION['cart']['customerID']=$row['id'];
			echo "testopaisedsoaödfjksaedöofgjae".$_SESSION['cart']['customerID'];
		}
*/
		if($pDisplay == true){
			if($count == 0)
			echo "Kein Kunde gefunden!";

			if($count==1){
				displayPersonData($result);
				echo "<br />";
				if(!isset($_GET['page']) && $_GET['page'] != 'konditionen'){
					displayArticles();
				}

				if($count>1)
					displayPersonDropDown($result);
			}
		}
		else {
			return $result;
		}
	}

	function findPersonAddress($pCritera){
		$query = "SELECT street, housenumber, stiege, doornumber, zip, city, country
			FROM person
			WHERE is_customer=1
			AND (lastname = '$pCritera' OR id = '$pCritera')";
		$result = mysql_query($query);
		return $result;
	}



	function displayPersonData($pData){
		echo "
			<fieldset>
				<legend>Kundenstammdaten</legend>
			<div id=\"Kundendaten\">
				<table>";

		while($row = mysql_fetch_assoc($pData)){
			$_SESSION['cartCustomerID']=$row['id'];

			echo "<tr>
					<td>Kunden-NR:</td>
					<td>{$row['id']}</td>
				</tr>
				<tr>
					<td>Name:</td>
					<td>{$row['firstname']}&nbsp;{$row['lastname']}</td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td>{$row['city']},&nbsp;{$row['street']}&nbsp;{$row['housenumber']}</td>
				</tr>";

		}
		echo "
				</table>
			</div>
			</fieldset>";
	}

	function displayPersonDropDown($pData){
		echo "Mehrere Kunden gefunden.. Bitte w&auml;hlen Sie!<br />";
		echo "<form method=\"POST\" action=\"" . $_SERVER["PHP_SELF"] . "?content=AngebotErstellen\">
				<select name=\"personSelectDropDown\"	>";				
				while($row = mysql_fetch_assoc($pData)){
					echo "<option value=\"".$row['id']."\">" . $row['id'] . " / " .
					$row['firstname'] . " / " .
					$row['lastname'] . " / " .
					"{$row['city']},&nbsp;{$row['street']}&nbsp;{$row['housenumber']}
					</option>";
				}
			echo "</select>";
			echo "<input type=\"submit\" name=\"personPicker\" value=\"Ok\" />";
		echo "</form>";
	}

	function displayArticles(){
		echo"
			<table>
				<tr>
					<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\"?content=AngebotErstellen\">
					<td>Bezeichnung / Artikelnummer:</td>
					<td><input type=\"text\" name=\"searchA\"></td>
					<td><input type=\"submit\" name=\"searchAButton\" value=\"suchen\">
				</tr>

			</table>
			";
		
	}


	function findArticle($pACritera, $display){
		$queryA = 
		"SELECT article.id, article.model, article.description, article.selling_price, article.stock, article_category.name 
		FROM article
		JOIN article_category ON ( article_category.id ) 
		WHERE(article.fk_article_category_id = article_category.id AND (article.id = '$pACritera' OR article.model = '$pACritera'))";
		$resultA = mysql_query($queryA);
		$countA = mysql_num_rows($resultA);
		
		if($display == true){
			if($countA == 0)
				echo "Kein Artikel gefunden!";

			if($countA>0)
				displayArticleList($resultA);
		}
		else
			return $resultA;
	}

	function displayArticleList($pAData){
	
			echo "<fieldset id=\"articleList\">
				<legend>Artikel</legend>
					<div id\"Artikeldaten\">";
			
			echo "
				<table id=\"artikelDatenTable\" rules=\"rows\">
				<thead>
					<tr>
						<td>ArtNr:</td>
						<td>Kategorie:</td>
						<td>Modell:</td>
						<td>Beschreibung:</td>
						<td>Preis/Einheit:</td>
						<td>Menge:</td>
					</tr>
				</thead>
				";	

			echo "<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\"?content=AngebotErstellen\">";
			echo "<tbody>";
			while($row = mysql_fetch_assoc($pAData)){
			echo "<tr>
					<td>{$row['id']}<input type=\"hidden\" name=\"['id']\" value=\"{$row['id']}\" /> 
					<td>{$row['name']}</td>
					<td>{$row['model']}</td>
					<!--<td>{$row['description']}</td>-->
					<td><a href=\"\" target=\"_blank\">&ouml;ffnen</td>
					<td>{$row['selling_price']}</td>
					<td>
						<input class=\"quantity\" type=\"number\" name=\"addQTY_{$row['id']}\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
						<input class=\"addButton\" type=\"submit\" name=\"addCart_{$row['id']}\" value=\"+\"/>
					</td>
				</tr>
				";	
			}	
			echo "</tbody>";

			echo"</form></table></div>
			</fieldset>";
		
	}

	function createCart(){
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart']=array();
		}
	}

	function addCart($pArticleID, $pQty){
		if($pQty < 0)
			return;

		if(cartIsEmpty())
			$_SESSION['cart'][$pArticleID]=$pQty;
		elseif(!array_key_exists($pArticleID, $_SESSION['cart'])){
			$_SESSION['cart'][$pArticleID]=$pQty;
		}
		elseif(array_key_exists($pArticleID, $_SESSION['cart'])){
			$_SESSION['cart'][$pArticleID]+=$pQty;
		}


	}

	function displayCart($displayButtons){
		if(cartIsEmpty())
			return;

		echo "<fieldset id=\"Warenkorb\">
			<legend>Warenkorb</legend>
				<div id\"warenkorb\">";
		
		echo "
			<table id=\"cart\" rules=\"rows\"*>
			<thead>
				<tr>
					<td>ArtNr:</td>
					<td>Kategorie:</td>
					<td>Modell:</td>
					<td>Beschreibung:</td>
					<td>Preis/Einheit:</td>
					<td>Menge:</td>
					";
					if($displayButtons === true)
						echo "<td>Entfernen</td>
				</tr>
			</thead>
			";
			echo "<form name=\"cartForm\" method=\"POST\" action=\"".$_SERVER['PHP_SELF']."?content=AngebotErstellen\">";
			echo "<tbody>";
		
		foreach($_SESSION['cart'] as $lItem => $lQty){
			$cartData = findArticle($lItem, false);

			while($row = mysql_fetch_assoc($cartData)){
			echo "<tr>
					<td>{$row['id']}<input type=\"hidden\" name=\"cartID\" value=\"{$row['id']}\" /> 
					<td>{$row['name']}</td>
					<td>{$row['model']}</td>
					<!--<td>{$row['description']}</td>-->
					<td><a href=\"\" target=\"_blank\">&ouml;ffnen</td>
					<td>{$row['selling_price']}</td>
					<td>
						$lQty
					</td>
					<td>";
					if($displayButtons === true){
					echo "<input class=\"quantity\" type=\"number\" name=\"deleteQTY_{$row['id']}\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
						<input class=\"addButton\" type=\"submit\" name=\"removeCartID_{$row['id']}\" value=\"-\"/>";
					}
				echo "
					</td>
				</tr>
				";
			}
		}
		echo"</form></tbody></table></div></fieldset>";
	}

	function removeCart($pArticleID, $pQty){
		if(array_key_exists($pArticleID, $_SESSION['cart']))
			$_SESSION['cart'][$pArticleID]-=$pQty;

		if($_SESSION['cart'][$pArticleID] < 1)
			unset($_SESSION['cart'][$pArticleID]);
	}

	function clearCart(){
		unset($_SESSION['cart']);
		$_SESSION['cart']=array();
	}
	function cartIsEmpty(){
		return empty($_SESSION['cart']);
	}

	function displayConditionsLink(){
		echo "<a href=\"{$_SERVER["PHP_SELF"]}?content=AngebotErstellen&page=konditionen\">weiter</a>";
	}

	function displayPersonAddress($pData){
		while($row = mysql_fetch_assoc($pData)){

		echo "		
			<form method=\"POST\" action=\"{$_SERVER['PHP_SELF']}?content=AngebotErstellen&page=CreateOffer\">
			<fieldset>
				<legend>Lieferadresse</legend>
			<table>
				<tr>
					<td>Straße:</td><td><input type=\"text\" name=\"strasse\" size=\"30\" value=\"{$row['street']}\" required></td>
					<td>Hausnummer:</td>
					<td><input type=\"text\" name=\"hausnr\" size=\"30\" value=\"{$row['housenumber']}\" required></td>
				</tr>
				<tr>
					<td>Stiege:</td>
					<td><input type=\"text\" name=\"stiege\" size=\"30\" value=\"{$row['stiege']}\"></td>
					<td>Tür:</td>
					<td><input type=\"text\" name=\"doornum\" size=\"30\" value=\"{$row['doornumber']}\"></td>
				</tr>
				<tr>
					<td>PLZ:</td>
					<td><input type=\"text\" name=\"zip\" size=\"30\" value=\"{$row['zip']}\" required></td>

					<td>Stadt:</td>
					<td><input type=\"text\" name=\"stadt\" size=\"30\" value=\"{$row['city']}\"required></td>
				</tr>
				<tr>
					<td>Land:</td>
					<td><input type=\"text\" name=\"land\" size=\"30\" value=\"{$row['country']}\"required></td>
				</tr>
			</table>
			</fieldset>
		";

		}
	}

	function displayPaymentDeliveryConditions(){
		echo "
			<fieldset>
				<legend>Zahlungsbedingungen</legend>
			<table>
				<tr>
					<td><input type=\"radio\" name=\"paymentMethod\" value=\"Bar\" checked=\"checked\">Bar&nbsp;&nbsp;</td>
   					<td><input type=\"radio\" name=\"paymentMethod\" value=\"Kreditkarte\">Visa/Mastercard&nbsp;&nbsp;</td>
    				<td><input type=\"radio\" name=\"paymentMethod\" value=\"14 Tage\">Auf Ziel (14 Tage)&nbsp;&nbsp;</td>
				</tr>
			</fieldset>
			<tr>	
				<td>&nbsp;</td>
			</tr>
				<tr>
					<td colspan=\"2\"><input type=\"checkbox\" name=\"montage\" value=\"1\" />&nbsp;&nbsp;Montage ben&ouml;tigt?</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			</fieldset>

			<input type=\"submit\" value=\"zum Abschlie&szlig;en\" class=\"createOffer\" name=\"buttonCreateOffer\" />
			</form>

		";

	}

	function displayConditionPage(){
		findPerson($_SESSION['cartCustomerID'], true);
		displayCart(false);
		echo " <br />";
		displayPersonAddress(findPersonAddress($_SESSION['cartCustomerID'],false));
		echo "<br />";
		displayPaymentDeliveryConditions();
	}

	function displayCheckOut(){
		setDeliveryAddress();
		setPaymentMethod();

		findPerson($_SESSION['cartCustomerID'], true);
		displayDeliveryAddress();
		echo "<br />";
		displayCart(false);
		echo "<br />";
		displayPaymentSummary();

	}

	function displayDeliveryAddress(){
		echo "<fieldset>
				<legend>Lieferadresse</legend>
			<table>
				<tr>
					<td>Straße:</td>
					<td>{$_SESSION['deliveryAddress']['strasse']}</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>Hausnummer:</td>
					<td>{$_SESSION['deliveryAddress']['hausnummer']}</td>
				</tr>
				<tr>
					<td>Stiege:</td>
					<td>{$_SESSION['deliveryAddress']['stiege']}</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>Tür:</td>
					<td>{$_SESSION['deliveryAddress']['doornum']}</td>
				</tr>
				<tr>
					<td>PLZ:</td>
					<td>{$_SESSION['deliveryAddress']['zip']}</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>Stadt:</td>
					<td>{$_SESSION['deliveryAddress']['stadt']},</td>
					<td>{$_SESSION['deliveryAddress']['land']}</td>
				</tr>
			</table>
			</fieldset>";
	}

	function displayPaymentSummary(){
		echo "<fieldset>
				<legend>Preis</legend>
			<table rules=\"groups\">";
			echo "<thead>";
			echo "<tr>
					<td>Preis/Stk</td>
					<td>Menge</td>
					<td>Gesamt</td>
				</tr>
				";
			echo "</thead>";
		$sum;
		foreach($_SESSION['cart'] as $lItem => $lQty){
			$cartData = findArticle($lItem, false);
			echo "<tr>";

			while($row = mysql_fetch_assoc($cartData)){
				echo "<td>";
					echo $row['selling_price'];
				echo "</td>";
				echo "<td>";
					echo $lQty;
				echo "</td>";
				echo "<td id=\"priceCalculation\">";
					printf("€ %-15.2f",$row['selling_price']*$lQty);
					$sum += $row['selling_price']*$lQty;
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "<tr>
				<td>&nbsp;</td>
				<td>Summe:</td>
				<td>";
			printf("€ %-15.2f",$sum);
		echo "	</td>
			</tr>";
		echo "</table></fieldset>";
		//<FORM METHOD=\"POST\" ACTION=\"/fosy/auftragsMgmt/content/AngebotPDF.php\">
		echo "
		<FORM METHOD=\"POST\" action=\"{$_SERVER['PHP_SELF']}?content=AngebotErstellen&action=createPDF\">
			<input type=\"submit\" value=\"Angebot erstellen\" />
		</FORM>";
	}

	function setDeliveryAddress(){
		$_SESSION['deliveryAddress']=array();
		$_SESSION['deliveryAddress']['strasse'] = $_POST['strasse'];
		$_SESSION['deliveryAddress']['hausnummer'] = $_POST['hausnr'];
		$_SESSION['deliveryAddress']['stiege'] = $_POST['stiege'];
		$_SESSION['deliveryAddress']['doornum'] = $_POST['doornum'];
		$_SESSION['deliveryAddress']['zip'] = $_POST['zip'];
		$_SESSION['deliveryAddress']['stadt'] = $_POST['stadt'];
		$_SESSION['deliveryAddress']['land'] =$_POST['land'];
	}

	function setPaymentMethod(){
		$_SESSION['paymentMethod'] = array();
		$_SESSION['paymentMethod']['Zahlart'] = $_POST['paymentMethod'];
		$_SESSION['paymentMethod']['Montage'] = $_POST['montage'];

	}

	function findOffer($pCritera) {
		$query = "SELECT fk_customer_id, fk_delivery_id, fk_order_id, number, date, valid_from, valid_until, code 
			FROM offer
			WHERE id = '$pCritera'";
		$result = mysql_query($query);
		return $result;
	}
	
	function saveOfferToDatabase(){
	/*	$db = new PDO('mysql:host=localhost;dbname=fosy;charset=utf8', 'fosy', 'fosyPassword');
		
		$sql = "insert into offer select :pCustomerID, :pDeliveryID, :pRechnungsnummer, now(), now(), :pValid_until"
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":pCustomerID", $CustomerID);
		$stmt->bindParam(":pDeliveryID", $CustomerID);
		$stmt->bindParam(":pRechnungsnummer", $CustomerID);
		$stmt->bindParam(":pValid_until", $CustomerID);

		$result = $stmt->fetchAll(PDO::Fetch_Assoc);

	$custID = $_SESSION['cart']['customerID'];
	$
	$queryOffer ="
	INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until)
	VALUES (23, 1, 'offer-1-2013', '2013-06-02', '2013-06-02', '2013-06-30');
	";
	*/	
		/*
		$street = mysqli_real_escape_string($_SESSION['deliveryAddress']['strasse']);
		$housenumber = mysqli_real_escape_string($_SESSION['deliveryAddress']['hausnummer']);
		$city = mysqli_real_escape_string($_SESSION['deliveryAddress']['stadt']);
		$zip = mysqli_real_escape_string($_SESSION['deliveryAddress']['zip']);
		$country = mysqli_real_escape_string($_SESSION['deliveryAddress']['land']);
		*/
		$street = $_SESSION['deliveryAddress']['strasse'];
		$housenumber = $_SESSION['deliveryAddress']['hausnummer'];
		$city = $_SESSION['deliveryAddress']['stadt'];
		$zip = $_SESSION['deliveryAddress']['zip'];
		$country = $_SESSION['deliveryAddress']['land'];
		$doornumber = $_SESSION['deliveryAddress']['doornum'];
		$stiege = $_SESSION['deliveryAddress']['stiege'];


		if(isset($_SESSION['paymentMethod']['Montage'])) {
			$assambly = 1;
		}else {
			$assambly = 0;
		}
		//$assembly = mysqli_real_escape_string($_SESSION['paymentMethod']['Montage']);
		$deliveryPrice = calculatePrice()*0.05;

		$queryDelivery ="
		INSERT INTO delivery (price, street, housenumber, stiege, doornumber, city, zip, country, assambly)
		VALUES ('$deliveryPrice', '$street', '$housenumber', '$stiege', '$doornumber', '$city', '$zip', '$country', '$assambly')";
		//echo $queryDelivery . "<br /><br />";
		mysql_query($queryDelivery);
		//mysql_error();
		$lastID = mysql_insert_id();
		
		$customerID = $_SESSION['cartCustomerID'];
		$maxID = mysql_query("SELECT MAX(id) FROM offer");
		$row = mysql_fetch_row($maxID);
		$lastOfferID = $row[0]+1;
		$offerNumberString = $row[0];

		//echo "OFFERNR:" . $offerNumberString . "<br />";
		$curYear = date("Y");
		$offerNumberString +=1;
		$offerNumber = "offer-$offerNumberString-$curYear";

		$queryOffer ="
			INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until)
			VALUES ('$customerID', '$lastID', '$offerNumber', now(), now(), DATE_ADD(now(),INTERVAL 14 DAY))";
		//echo $queryOffer . "<br /><br />";
		mysql_query($queryOffer);
			//	mysql_error();
		///$lastOfferID = mysql_insert_id();
	
		foreach($_SESSION['cart'] as $lItem => $lQty){
			$cartData = findArticle($lItem, false);
		
            while($row = mysql_fetch_assoc($cartData)){
            	$artID = $row['id'];
            	$queryOfferArticle ="
					INSERT INTO 'offer_article' ('fk_article_id', 'fk_offer_id', 'count')
					VALUES('$artID', '$lastOfferID', '$lQty')";
					//echo "$lastOfferID <br /><br />".$queryOfferArticle . "<br /><br />";
					mysql_query($queryOfferArticle);
					//mysql_error();
			}
		}
		clearCart();
}

	function calculatePrice(){
		$price=0;
		foreach($_SESSION['cart'] as $lItem => $lQty){
			$cartData = findArticle($lItem, false);
		
			while($row = mysql_fetch_assoc($cartData)){
				$price += $row['selling_price']*$lQty;
			}
		}
		return $price;
	}

?>