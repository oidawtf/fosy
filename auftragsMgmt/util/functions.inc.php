<?php
	function isLoggedIn() {
		return isset($_SESSION['fosy_session']);
	}
	
	function isLoginValid($username, $password) {
		// TODO make it clean
		
		$username = format($username);
		$password = format($password);
		$password = md5($password);
		
		// Hier query auslagern
		$query = mysql_query("SELECT * FROM person WHERE username='$username' and password='$password'");

		$result = mysql_num_rows($query); // TODO check was methode liefert
				
		return $result; // TODO nach check der methode, eventuell true zurueckgeben
	}
	
	function login($username) {
		$_SESSION['fosy_session'] 	= 1;
		$_SESSION['username'] 		= $username;
	}
	
	function logout() {
		session_unset();
		session_destroy();
		$_SESSION = array();
	}
	
	function format($input) {
		$input = stripslashes($input);
		$input = mysql_real_escape_string($input);
		return $input;
	}

	function findPerson($pCritera){
		$query = "SELECT id, firstname, lastname, city, street, housenumber
			FROM person
			WHERE is_customer=1
			AND (lastname = '$pCritera' OR id = '$pCritera')";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);
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

	function displayPersonData($pData){
		echo "
			<fieldset>
				<legend>Kundenstammdaten</legend>
			<div id=\"Kundendaten\">
				<table>";

		while($row = mysql_fetch_assoc($pData)){
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
		echo "<form method=\"POST\" action=\"" . $_SERVER["PHP_SELF"] . "?content=home\">
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
					<td><input type=\"text\" name=\"search\"></td>
					<td><input type=\"submit\" name=\"searchButton\" value=\"suchen\">
				</tr>

			</table>
			";
		echo "<fieldset>
				<legend>Artikel</legend>
					<div id\"Artikeldaten\">
					</div>
			</fieldset>";
	}




?>