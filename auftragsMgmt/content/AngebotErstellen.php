<div>
	<table>
		<tr>
			<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=AngebotErstellen">
			<td>Kundennummer / Name:</td>
			<td><input type="text" name="search"></td>
			<td><input type="submit" name="searchButton" value="suchen">
		</tr>
	</table>
		
		<?php
			if(isset($_POST['search']) && isset($_POST['searchButton'])){
				findPerson($_POST['search'],true);
			}
			
			if(!isset($_POST['search']) && !isset($_POST['searchButton']) && !isset($_POST['personSelectDropDown']) && !isset($_POST['personPicker']))
				echo "Noch kein Kunde? <a href=\"http://localhost/fosy/crm/index.php?content=createcustomer&prevPage=true\">Anlegen</a>";


			if(isset($_POST['personSelectDropDown']) && isset($_POST['personPicker'])){
				findPerson($_POST['personSelectDropDown'],true);
			}

			if(isset($_POST['searchA']) && isset($_POST['searchAButton'])){
				if(isset($_SESSION['cart']['customerID'])){
					findPerson($_SESSION['cart']['customerID'],true);
				}
				findArticle($_POST['searchA']);
			}
		?>

	</form>
</div>