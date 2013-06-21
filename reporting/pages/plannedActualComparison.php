<h2>Plan-Ist-Vergleich</h2>
<br>
<?php
	// do comparison or create plan pdf clicked 
	if(	isset($_POST['doComparison']) || isset($_POST['createPlanPDF'])) {
		$errorMsg = "";
		
		if( checkPlannedIndicator($_POST['planIndicatorsSelect']) ) {
			// todo check time
			if(checkPlanWhichTime($_POST['planWhichTime'])) {
				if($_POST['planWhichTime'] == 1) { // Monat
					if( checkMonthSelected($_POST['planByMonthMonth']) && checkYearSelected($_POST['planByMonthYear']) ) {
						$dataCorrect = true;
					}else {
						$errorMsg .= "Bitte Monat und Jahr auswählen.<br/>";
					}
				} else if($_POST['planWhichTime'] == 2) { // Quartal
					if( checkQuarterSelected($_POST['planByQuarterQuarter']) && checkYearSelected($_POST['planByQuarterYear']) ) {
						$dataCorrect = true;
					}else {
						$errorMsg .= "Bitte Quartal und Jahr auswählen.<br/>";
					}
				}else { // Jahr
					if(checkYearSelected($_POST['planByYearYear'])) {
						$dataCorrect = true;
					}else {
						$errorMsg .= "Bitte Jahr auswählen.<br/>";
					}
				}
			} else {
				$errorMsg .= "Bitte einen Zeitraum auswählen.<br/>";
			}
		}else {
			$errorMsg .= "Bitte eine Kennzahl auswählen.<br/>";
		}
		
		if($dataCorrect) {
			switch($_POST['planWhichTime']) {
				case 1: // Monat
					$period = "1 Monat";
					$dateFromDB = getDateFrom($_POST['planByMonthMonth']."-".$_POST['planByMonthYear']);
					$dateToDB = getDateTo($_POST['planByMonthMonth']."-".$_POST['planByMonthYear']);
					break;
				case 2: // Quartal
					// 1. Quartal: 1*3 = 3  -> 3-2  = 1
					// 2. Quartal: 2*3 = 6  -> 6-2  = 4
					// 3. Quartal: 3*3 = 9  -> 9-2  = 7
					// 4. Quartal: 4*3 = 12 -> 12-2 = 10
					$period = "1 Quartal";
					$endMonth = $_POST['planByQuarterQuarter'] * 3;
					$startMonth = $endMonth - 2;
					$dateFromDB = getDateFrom($startMonth."-".$_POST['planByQuarterYear']);
					$dateToDB = getDateTo($endMonth."-".$_POST['planByQuarterYear']);
					break;
				case 3: // Jahr
					$period = "1 Jahr";
					$dateFromDB = getDateFrom("1-".$_POST['planByYearYear']);
					$dateToDB = getDateTo("12-".$_POST['planByYearYear']);
					break;
			}
			
			//echo "perdiod: " . $period . " | dateFromDB: " . $dateFromDB . " | dateToDB: " . $dateToDB . "<br>";
			if(isset($_POST['doComparison'])) {
				$result = generatePlannedActualComparison($_POST['planIndicatorsSelect'], $period, $dateFromDB, $dateToDB);
			}else {
				echo '<script type="text/javascript">
					window.open("pages/generatePDFPlanned.php?planIndicatorsSelect='.$_POST['planIndicatorsSelect'].'&period='.$period.'&dateFromDB='.$dateFromDB.'&dateToDB='.$dateToDB.'");
					</script>';
			}
		}
		
	}
	
	if(!empty($errorMsg)) { echo "<div id='error' class='ui-state-error'>".$errorMsg."</div><br/>"; }
		
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=plannedActualComparison">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Plan-Ist-Vergleich durchführen</legend>
		
		<div id="planKZ">
			<label>Kennzahl:</label>
			<select id="planIndicatorsSelect" name="planIndicatorsSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php 

					$indicators = getIndicators();
			
					foreach($indicators as $indicator) {
						echo "<option value='$indicator[id]'";
						if($_POST['allIndicatorsSelect']==$indicator[id]){ echo " selected='selected'"; }
						echo ">$indicator[name] ($indicator[type])</option>";
					}
				?>
			</select>
		</div>
		
		<div id="noPlannedvalues">Für die ausgewählte Kennzahl sind keine Plan-Daten hinterlegt.</div>
		
		<div id="planWhichTimeBlock">
			<label>Zeitraum:</label>
			<select id="planWhichTime" name="planWhichTime" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<option value="1">Monat</option>
				<option value="2">Quartal</option>
				<option value="3">Jahr</option>
			</select>
		</div>
		
		<div id="timeMonthBlock">
			<label>Datum:</label>
			<select id="planByMonthMonth" name="planByMonthMonth" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$months = array(1=>"Jan", 2=>"Feb", 3=>"Mär", 4=>"Apr", 5=>"Mai", 6=>"Jun", 7=>"Jul", 8=>"Aug", 9=>"Sep", 10=>"Okt", 11=>"Nov", 12=>"Dez");
					for($i = 1; $i <= count($months); $i++) {
						echo "<option value='$i'>$months[$i]</option>";
					}
				?>
			</select>
			<select id="planByMonthYear" name="planByMonthYear" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$curYear = date('Y');
					for($i = 0; $i < 7; $i++) {
						$year = $curYear - $i;
						echo "<option value='$year'>$year</option>";
					}
				?>
			</select>
		</div>
		<div id="timeQuarterBlock">
			<label>Datum:</label>
			<select id="planByQuarterQuarter" name="planByQuarterQuarter" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$quarters = array(1=>"1. Quartal", 2=>"2. Quartal", 3=>"3. Quartal", 4=>"4. Quartal");
					for($i = 1; $i <= count($quarters); $i++) {
						echo "<option value='$i'>$quarters[$i]</option>";
					}
				?>
			</select>
			<select id="planByQuarterYear" name="planByQuarterYear" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$curYear = date('Y');
					for($i = 0; $i < 7; $i++) {
						$year = $curYear - $i;
						echo "<option value='$year'>$year</option>";
					}
				?>
			</select>
		</div>
		<div id="timeYearBlock">
			<label>Datum:</label>
			<select id="planByYearYear" name="planByYearYear" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php
					$curYear = date('Y');
					for($i = 0; $i < 7; $i++) {
						$year = $curYear - $i;
						echo "<option value='$year'>$year</option>";
					}
				?>
			</select>
		</div>
		<br/>
		<div class="clear">
			<button type="submit" name="doComparison" id="doComparison">Vergleich durchführen</button>
			<button type="submit" name="createPlanPDF" id="createPlanPDF">PDF erstellen</button>
		</div>
		<br/>
		<div id="resultDiv">
			<?php 
				if($result != -1) {
					echo $result;
				}else {
					echo "Es sind keine Plandaten für die Kennzahl hinterlegt.";
				}
			?></div>
	</fieldset>
</form>