<h3>Eingangsrechnung erfassen</h3>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=erErfassen">
	<fieldset>
		<legend>Eingangsrechnung erfassen</legend>
		<div>
			<label>Datum:</label>
			<input type="text" id="datepicker" />
		</div>
		<div>
			<label>BelegNr:</label>
			<input type="text">
		</div>
		<div>
			<label>Brutto-Betrag:</label>
			<input type="text">
		</div>
	</fieldset>
	
	<button type="submit" name="login">Login</button>
</form>
