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
		</table>";
}

function findOffers($pCriteria, $display){
	$query = "SELECT id, fk_customer_id
			FROM offer
			JOIN person ON ( person.id ) 
			WHERE(offer.fk_customer_id = person.id AND (person.id = '$pCriteria' OR person.lastname = '$pCriteria'))";
	$result = mysql_query($query);

	$count = mysql_num_rows($resultA);
		
	if($display == true){
		if($count == 0)
			echo "Keine Angebote gefunden!";

		if($count>0)
			displayOrderList($result);
	}
	else
		return $result;
}

function displayOrderList($pData){
	echo "<fieldset id=\"articleList\">
		<legend>Artikel</legend>
			<div id\"Artikeldaten\">";
	
	echo "
		<table id=\"artikelDatenTable\" rules=\"groups\">
		<thead>
			<tr>
				<td>Angebots-ID</td>
				<td>Kundennummer</td>
				<td>Gesamt-Preis</td>

			</tr>
		</thead>
		";	

	echo "<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\"?content=AngebotErstellen\">";
	echo "<tbody>";
	while($row = mysql_fetch_assoc($pData)){
	echo "<tr>
			<td>{$row['id']}</td>
			<td>{$row['fk_customer_id']}</td>
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

?>