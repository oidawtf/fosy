<?php
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
				displayArticles();
			}

			if($count>1)
				displayPersonDropDown($result);
		}
		else
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
						<input class=\"quantity\" type=\"number\" name=\"QTY\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
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
		if(cartIsEmpty())
			$_SESSION['cart'][$pArticleID]=$pQty;
		elseif(!array_key_exists($pArticleID, $_SESSION['cart'])){
			$_SESSION['cart'][$pArticleID]=$pQty;
		}
		elseif(array_key_exists($pArticleID, $_SESSION['cart'])){
			$_SESSION['cart'][$pArticleID]+=$pQty;
		}


	}

	function displayCart(){
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
					<td>Entfernen</td>
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
					<td>
						<input class=\"quantity\" type=\"number\" name=\"cartQTY\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
						<input class=\"addButton\" type=\"submit\" name=\"removeCart\" value=\"-\"/>
					</td>

				</tr>
				";
			}
		}
		echo"</form></tbody></table></div></fieldset>";
	}

	function removeCart($pArticleID, $pQty){
		if(array_key_exists($pArticleID, $_SESSION['cart']))
			$_SESSION['cart'][$pArticleID]-$pQty;

		if($_SESSION['cart'][$pArticleID] < 0)
			unset($_SESSION['cart'][$pArticleID]);
	}

	function clearCart(){
		unset($_SESSION['cart']);
		$_SESSION['cart']=array();
	}
	function cartIsEmpty(){
		return empty($_SESSION['cart']);
	}
?>