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
?>