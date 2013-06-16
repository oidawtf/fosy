<h2>Plandaten hinzufügen</h2>
<br/>
<?php 
	// save clicked 
	if(isset($_POST['save']) && checkPlannedIndicator($_POST['indicatorsAddSelect']) && checkPeriod($_POST['periodSelect']) && checkValue($_POST['wert']) && checkPlannedvalueType($_POST['plannedvalueType'])) {
		savePlannedvalue($_POST['indicatorsAddSelect'], $_POST['periodSelect'], $_POST['wert'], $_POST['plannedvalueType']);
	
	} else {	
		if(isset($_POST['save'])) {
			$errorMsg = "";
			if(!checkPlannedIndicator($_POST['indicatorsAddSelect'])) {
				$errorMsg .= "Bitte Kennzahl auswählen.<br/>"; 
			}
			if(!checkPeriod($_POST['periodSelect'])) {
				$errorMsg .= "Bitte Zeitraum auswählen.<br/>";
			}
			if(!checkValue($_POST['wert'])) { 
				$errorMsg .= "Bitte Wert eingeben.<br/>"; 
			}
			if(!checkPlannedvalueType($_POST['plannedvalueType'])) {
				$errorMsg .= "Bitte Kennzahlentype auswählen.<br/>";
			}
						
			if(!empty($errorMsg)) { echo "<div id='error' class='ui-state-error'>".$errorMsg."</div><br/>"; }
		}

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=addPlannedvalue">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Plandaten hinzufügen</legend>

		<div>
			<label>Kennzahl:</label>
			<select id="indicatorsAddSelect" name="indicatorsAddSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
			<?php 
				$indicators = getIndicatorsWithLess3Values();
			
				foreach($indicators as $indicator) {
					echo "<option value='$indicator[id]'";
					if($_POST['indicatorsAddSelect']==$indicator[id]){ echo " selected='selected'"; }
					echo ">$indicator[name]</option>";
				}
			?>
			</select>
		</div>
		<div id="periods">
			<label>Zeitraum:</label>
			<select id="periodSelect" name="periodSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
			<?php 
				$periods = getPeriods();
				foreach($periods as $period) {
					echo "<option value='$period[id]'";
					if($_POST['periodSelect']==$period['id']) { echo " selected='selected'"; }
					echo ">$period[value]</option>";
				}
			?>
			</select>
		</div>
		<div id="plannedvalue">
			<label>Wert:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="wert" name="wert" value="<?php echo $_POST['wert']; ?>">
			<select id="plannedvalueType" name="plannedvalueType" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$plannedvalueTypes = getPlannedvalueTypes();
					foreach($plannedvalueTypes as $plannedvalueType) {
						echo "<option value='$plannedvalueType[id]'";
						if($_POST['plannedvalueType']==$plannedvalueType[id]) { echo " selected='selected'"; }
						echo ">$plannedvalueType[type]</option>";
					}
				?>
			</select>
		</div>
		<div>
			<button type="submit" name="save" id="save">Speichern</button>
		</div>
	</fieldset>
</form>

<?php } ?>