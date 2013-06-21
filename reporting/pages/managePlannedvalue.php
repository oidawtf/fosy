<h2>Plandatenverwaltung</h2>
<br/>

<form method="POST" action="#">
	<fieldset class="ui-widget ui-widget-content-white ui-corner-all">
		<legend>Plandatenverwaltung</legend>
		
		<div>
			<label>Kennzahl:</label>
			<select id="indicatorsSelect" class="ui-widget ui-widget-content ui-corner-all">
				<option value="0"><--wählen--></option>
				<?php 

					$indicators = getIndicators();
			
					foreach($indicators as $indicator) {
						echo "<option value='$indicator[id]'>$indicator[name]</option>";
					}
				?>
			</select>
		</div>
		<div id="resultDiv"></div>
		<br/>
		<div><a class="button" href="<?php echo $_SERVER['PHP_SELF'];?>?content=addPlannedvalue">Plandaten hinzufügen</a></div>
	</fieldset>
</form>
