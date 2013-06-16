<h2>Flexible Reports</h2>
<br/>
<?php
	
	// create report clicked 
	if(	(isset($_POST['createReport']) || isset($_POST['createPDF'])) && 
		checkFlexibleIndicator($_POST['allIndicatorsSelect']) && 
		checkDateFormatValid($_POST['dateFrom']) && 
		checkDateFormatValid($_POST['dateTo']) && 
		checkDateNotInFuture($_POST['dateFrom']) && 
		checkDateFromBeforeDateTo($_POST['dateFrom'], $_POST['dateTo']) ) {
		
		if(isset($_POST['createReport'])) {
			$result = generateReport($_POST['allIndicatorsSelect'], $_POST['dateFrom'], $_POST['dateTo']);
		}else {
			echo '<script type="text/javascript">
				window.open("pages/generatePDFReport.php?allIndicatorsSelect='.$_POST['allIndicatorsSelect'].'&dateFrom='.$_POST['dateFrom'].'&dateTo='.$_POST['dateTo'].'");
				</script>';
		}
		
		
	} else {
		if(isset($_POST['createReport'])) {
			$errorMsg = "";
			if(!checkFlexibleIndicator($_POST['allIndicatorsSelect'])) {
				$errorMsg .= "Bitte eine Kennzahl auswählen.<br/>";
			}
			if(!checkDateFormatValid($_POST['dateFrom'])) {
				$errorMsg .= "Bitte Von-Datum im gültigen Format (tt.mm.jjjj) auswählen/eingeben.<br/>"; 
			}
			if(!checkDateFormatValid($_POST['dateTo'])) {
				$errorMsg .= "Bitte Bis-Datum im gültigen Format (tt.mm.jjjj) auswählen/eingeben.<br/>"; 
			}
			
			if(!checkDateNotInFuture($_POST['dateFrom'])) {
				$errorMsg .= "Das Von-Datum darf nicht in der Zukunft liegen.<br/>";
			}
			
			if(!checkDateFromBeforeDateTo($_POST['dateFrom'], $_POST['dateTo'])) {
				$errorMsg .= "Das Von-Datum darf nicht nach dem Bis-Datum liegen.<br/>"; 
			}
						
			if(!empty($errorMsg)) { echo "<div id='error' class='ui-state-error'>".$errorMsg."</div><br/>"; }
		}
	}
		
?>


<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=flexibleReports">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Flexible Report erstellen</legend>
		
		<div>
			<label>Kennzahl:</label>
			<select id="allIndicatorsSelect" name="allIndicatorsSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php 

					$allIndicators = getAllIndicators();
			
					foreach($allIndicators as $indicator) {
						echo "<option value='$indicator[id]'";
						if($_POST['allIndicatorsSelect']==$indicator[id]){ echo " selected='selected'"; }
						echo ">$indicator[name] ($indicator[type])</option>";
					}
				?>
			</select>
		</div>
		<div id="flexZeit">
			<label>Zeitraum von:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" name="dateFrom" id="datepickerFrom" value="<?php if(isset($_POST['dateFrom'])) { echo $_POST['dateFrom']; } else { echo '01.06.2013'; } ?>"/> 
		</div>
		<div>
			<label>Zeitraum bis:</label>
			<input class="ui-widget ui-widget-content ui-corner-all" type="text" name="dateTo" id="datepickerTo" value="<?php if(isset($_POST['dateTo'])) { echo $_POST['dateTo']; } else { echo '30.06.2013'; } ?>"/>
		</div>
		<br/>
		<div>
			<button type="submit" name="createReport" id="createReport">Report erstellen</button>
			<button type="submit" name="createPDF" id="createPDF">PDF erstellen</button>
		</div>
		<br/>
		<div id="resultDiv"><?php echo $result;?></div>
	</fieldset>
</form>
