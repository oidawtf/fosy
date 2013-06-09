<h2>Plandatenverwaltung</h2>
<br/>

<div>Kennzahl:
	<select id="plandaten-select" class="ui-widget ui-widget-content ui-corner-all">
		<option value="0"><--wählen--></option>
	<?php 

		$indicators = getIndicators();
			
		foreach($indicators as $indicator) {
			echo "<option value='$indicator[id]'>$indicator[name]</option>";
		}
	?>
	</select>
</div>
<br/>
<div id="resultDiv"></div>
<br/>
<div><a class="button" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=editPlannedValue">Plandaten hinzufügen</a></div>

