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

		switch(mysql_num_rows($result)){
			case 0:
				echo "Kein Kunde gefunden!";
				break;
			case 1:
				displayPersonData($result);
				break;
			case 2:
				//displayPersonDropDown();
		}
	}

	function displayPersonData($pData){
		echo "
			<fieldset>
				<legend>Kundenstammdaten</legend>
					<table>
			";

		while($row = mysql_fetch_assoc($pData)){
			echo "<tr>
					<td>Kundennummer:</td>
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

		echo "		</table>
			</fieldset>";
	}



?>