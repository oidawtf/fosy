<h2>Eingangsrechnung erfassen</h2>
<br/>
<?php
	
	// save clicked 
	if(isset($_POST['save']) && checkDateFormatValid($_POST['date']) && checkDateNotInFuture($_POST['date']) &&  checkBelegNr($_POST['belegNr']) && checkBruttoBetrag($_POST['bruttoBetrag'])) {
		
		saveIncominginvoice($_POST['date'], $_POST['belegNr'], $_POST['bruttoBetrag'], $_POST['tax']);
	
	} else {
		if(isset($_POST['save'])) {
			$errorMsg = "";
			if(!checkDateFormatValid($_POST['date'])) {
				$errorMsg .= "Bitte Datum im gültigen Format (tt.mm.jjjj) auswählen/eingeben.<br/>"; 
			}
			if(!checkDateNotInFuture($_POST['date'])) {
				$errorMsg .= "Das Datum darf nicht in der Zukunft liegen.<br/>";
			}
			if(!checkBelegNr($_POST['belegNr'])) { 
				$errorMsg .= "Bitte BelegNr. eingeben.<br/>"; 
			}
			if(!checkBruttoBetrag($_POST['bruttoBetrag'])) {
				$errorMsg .= "Bitte Brutto-Betrag im gültigen Format (xxxx.yy) eingeben.<br/>";
			}
						
			if(!empty($errorMsg)) { echo "<div id='error' class='ui-state-error'>".$errorMsg."</div><br/>"; }
		}
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=addIncomminginvoice">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Eingangsrechnung erfassen</legend>
		<div>
			<label>Datum:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" name="date" id="datepicker" value="<?php echo $_POST['date']; ?>"/>
		</div>
		<div>
			<label>BelegNr:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="belegNr" name="belegNr" value="<?php echo $_POST['belegNr']; ?>">
		</div>
		<div>
			<label>Brutto-Betrag:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="bruttoBetrag" name="bruttoBetrag" value="<?php echo $_POST['bruttoBetrag']; ?>">
			
		</div>
		<div>
			<label>Steuersatz:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="radio" name="tax" value="10"> 10 %
			<input class="ui-widget ui-widget-content ui-corner-all" type="radio" name="tax" value="20" checked> 20 %
		</div>
		<div id="taxError" class="ui-state-error"></div>
		<div id="taxOutput" class="ui-state-highlight">
			<div>
				<label>Netto-Betrag:</label>
				<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="nettoBetrag" disabled="disabled"><br>
			</div>
			<div>
				<label>VST:</label>
				<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="vst" disabled="disabled">
			</div>
		</div>
		<div>
			<button type="button" id="calculate">Berechnen</button>
			<button type="submit" name="save" id="save">Speichern</button>
		</div>
		
	</fieldset>
</form>
<?php
	} // else end 
?>


