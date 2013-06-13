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
			$_SESSION['cart']['customerID']=$row['id'];

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
		createCart();

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


	function findArticle($pACritera){
		$queryA = 
		"SELECT article.id, article.model, article.description, article.selling_price, article.stock, article_category.name 
		FROM article
		JOIN article_category ON ( article_category.id ) 
		WHERE(article.fk_article_category_id = article_category.id AND (article.id = '$pACritera' OR article.model = '$pACritera'))";
		$resultA = mysql_query($queryA);
		$countA = mysql_num_rows($resultA);
		if($countA == 0)
			echo "Kein Artikel gefunden!";

		if($countA>0)
			displayArticleList($resultA);
	}

	function displayArticleList($pAData){
	
			echo "<fieldset>
				<legend>Artikel</legend>
					<div id\"Artikeldaten\">";
			
			echo "
				<table>
				<tr>
					<td>Artikelnummer:</td>
					<td>Kategorie:</td>
					<td>Modell:</td>
					<td>Beschreibung:</td>
					<td>Preis/Einheit:</td>
					<td>Lagerstand:</td>
					<td>Menge:</td>
				</tr>
				";	


			while($row = mysql_fetch_assoc($pAData)){
			echo "<tr>
					<td>{$row['id']}</td>
					<td>{$row['name']}</td>
					<td>{$row['model']}</td>
					<!--<td>{$row['description']}</td>-->
					<td><a href=\"\" target=\"_blank\">&ouml;ffnen</td>
					<td>{$row['selling_price']}</td>
					<td>{$row['stock']}</td>
				</tr>
				";	

			}	

			echo"</table></div>
			</fieldset>";
		
	}
	function createCart(){
		$_SESSION['cartItemQuantity']=0;
		$_SESSION['cartCount']=1;
	}

	function addCart($pArticle, $pQty){
		$_SESSION['cart'][$_SESSION['cartCount']] = $pArticle; 
		$_SESSION['cartItemQuantity'][$_SESSION['cartCount']] = $pQty; 
		$_SESSION['cartCount']+=1;
	}

	function displayCart(){
		var_dump($_SESSION['cart']);
	}



?>