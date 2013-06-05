<h3>Eingangsrechnung erfassen</h3>
<br/>
<?php
	
	// save clicked 
	if(isset($_POST['save']) && checkDateFormatValid($_POST['date']) && checkDateNotInFuture($_POST['date']) &&  checkBelegNr($_POST['belegNr']) && checkBruttoBetrag($_POST['bruttoBetrag'])) {
		
		saveIncomingInvoice($_POST['date'], $_POST['belegNr'], $_POST['bruttoBetrag'], $_POST['tax']);
	
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
				$errorMsg .= "Bitte gültigen (positiven) Brutto-Betrag eingeben.<br/>";
			}
						
			if(!empty($errorMsg)) { echo "<div id='error'>".$errorMsg."</div><br/>"; }
		}
?>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=erErfassen">
	<fieldset>
		<legend>Eingangsrechnung erfassen</legend>
		<div>
			<label>Datum:</label>
			<input type="text" name="date" id="datepicker" value="<?php echo $_POST['date']; ?>"/>
		</div>
		<div>
			<label>BelegNr:</label>
			<input type="text" id="belegNr" name="belegNr" value="<?php echo $_POST['belegNr']; ?>">
		</div>
		<div>
			<label>Brutto-Betrag:</label>
			<input type="text" id="bruttoBetrag" name="bruttoBetrag" value="<?php echo $_POST['bruttoBetrag']; ?>">
			
		</div>
		<div>
			<label>Steuersatz:</label>
			<input type="radio" name="tax" value="10"> 10 %
			<input type="radio" name="tax" value="20" checked> 20 %
		</div>
		<div id="taxError"></div>
		<div id="taxOutput">
			<div>
				<label>Netto-Betrag:</label>
				<input type="text" id="nettoBetrag"><br>
			</div>
			<div>
				<label>VST:</label>
				<input type="text" id="vst">
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


