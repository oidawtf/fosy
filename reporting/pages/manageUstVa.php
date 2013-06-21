<h2>UST VA erstellen</h2>
<br/>
<?php

	// print clicked 
	if(isset($_POST['ustvaprint']) && (isset($_POST['selectedMonth'])) ) {

		foreach($_POST['selectedMonth'] as $monthYear) {
			$month = getMonthOrYearFromMonthYear($monthYear, 'm');
			$path = generatePdf($monthYear);
			if($path != -1) {
				saveUstVa($monthYear, $path);
			}else {
				$errorMsg = "<div id='ustVaNoData' class='ui-state-highlight'>Sorry, do data in the database.</div><br/>";
			}
		}
		if(!empty($errorMsg)) { echo $errorMsg; }
	} 
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?content=manageUstVa">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>UST VA erstellen</legend>
		<div>
			<label>Jahr:</label>
			<select id="ustVAJahrSelect" name="ustVAJahrSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<option value="2013">2013</option>
				<option value="2012">2012</option>
				<option value="2011">2011</option>
				<option value="2010">2010</option>
				<option value="2009">2009</option>
				<option value="2008">2008</option>
				<option value="2007">2007</option>
			</select>
		</div>
		<div id="resultDiv"></div>
		<br/>
		<div id="printButton">
			<button type="submit" name="ustvaprint" id="ustvaprint">UST VA drucken</button>
		</div>
	</fieldset>
</form>
