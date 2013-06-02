<h3>Eingangsrechnung erfassen</h3>
<br/>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=erErfassen">
	<fieldset>
		<legend>Eingangsrechnung erfassen</legend>
		<div>
			<label>Datum:</label>
			<input type="text" id="datepicker" class="ui-widget ui-widget-content ui-corner-all"/>
		</div>
		<div>
			<label>BelegNr:</label>
			<input type="text" class="ui-widget ui-widget-content ui-corner-all">
		</div>
		<div>
			<label>Brutto-Betrag:</label>
			<input type="text" class="ui-widget ui-widget-content ui-corner-all">
		</div>
		<div>
			<button type="submit" name="save" id="save">Speichern</button>
		</div>
		
	</fieldset>
	
	</form>
