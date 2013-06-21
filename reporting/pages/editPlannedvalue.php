<h2>Plandaten bearbeiten</h2>
<?php 
	// save clicked 
	if(isset($_POST['save']) && checkValue($_POST['wert']) && checkPlannedvalueType($_POST['plannedvalueType'])) {
		
		updatePlannedvalue($_POST['pvID'], $_POST['wert'], $_POST['plannedvalueType']);
	
	} else {
		if(isset($_POST['save'])) {
			$errorMsg = "";
			if(!checkValue($_POST['wert'])) { 
				$errorMsg .= "Bitte Wert eingeben.<br/>"; 
			}
			if(!checkPlannedvalueType($_POST['plannedvalueType'])) {
				$errorMsg .= "Bitte Kennzahlentype auswählen.<br/>";
			}
						
			if(!empty($errorMsg)) { echo "<div id='error' class='ui-state-error'>".$errorMsg."</div><br/>"; }
		}else {
			$plannedvalue = getPlannedvalue($_GET['pvID']);
		}

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=editPlannedvalue">
	<input type="hidden" name="pID" value="<?php echo $plannedvalue[0]['pID']; ?>"/>
	<input type="hidden" name="pvID" value="<?php echo $plannedvalue[0]['pvID']; ?>"/>
	
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Plandaten bearbeiten</legend>

		<div>
			<label>Kennzahl:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="indicator" name="indicator" disabled="disabled" value="<?php echo $plannedvalue[0]['iName']; ?>">
		</div>
		<div id="periods">
			<label>Zeitraum:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="period" name="period" disabled="disabled" value="<?php echo $plannedvalue[0]['pValue']; ?>">
		</div>
		<div id="plannedvalue">
			<label>Wert:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" id="wert" name="wert" value="<?php if(isset($_POST['wert'])) { echo $_POST['wert']; } else{ echo $plannedvalue[0]['pvValue']; } ?>">
			<select id="plannedvalueType" name="plannedvalueType" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$plannedvalueTypes = getPlannedvalueTypes();
					foreach($plannedvalueTypes as $plannedvalueType) {
						echo "<option value='$plannedvalueType[id]'";
						if(isset($_POST['plannedvalueType'])) {
							if($_POST['plannedvalueType']==$plannedvalueType[id]) { echo " selected='selected'"; }
						}else {
							if($plannedvalue[0]['pvtID']==$plannedvalueType[id]) { echo " selected='selected'"; } 
						}
						echo ">$plannedvalueType[type]</option>";
					}
				?>
			</select>
		</div>
		<div id="saveButton">
			<button type="submit" name="save" id="save">Speichern</button>
		</div>
	</fieldset>
</form>

<?php } ?>