<div>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=AngebotErstellen">
		<table>
			<tr>
				<td>Kundennummer / Name:</td>
				<td><input type="text" name="search"></td>
				<td><input type="submit" name="searchButton" value="suchen">
				<td>Noch kein Kunde? <a href="http://localhost/fosy/crm/index.php?content=createcustomer&prevPage=true">Anlegen</a></td>
			</td></tr>
		</table>
		
			<?php
				if(isset($_POST['search']) && isset($_POST['searchButton'])){
					findPerson($_POST['search']);
				}
			?>

	</form>

</div>