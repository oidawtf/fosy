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
		echo '<pre>'; var_dump($_POST); echo '</pre>';  
			
			foreach($_POST as $key => $value) {
			  $pos = strpos($key , "addCart_");
			  if ($pos === 0){
			    $pos=substr($key,8);
			  }
			}

		
			if(isset($_POST['search']) && isset($_POST['searchButton'])){
				findPerson($_POST['search'],true);
			}
			
			if(!isset($_POST['search']) && !isset($_POST['searchButton']) && !isset($_POST['personSelectDropDown']) && !isset($_POST['personPicker']))
				echo "Noch kein Kunde? <a href=\"http://localhost/fosy/crm/index.php?content=createcustomer&prevPage=true\">Anlegen</a>";


			if(isset($_POST['personSelectDropDown']) && isset($_POST['personPicker'])){
				findPerson($_POST['personSelectDropDown'],true);
			}

			if(isset($_POST['searchA']) && isset($_POST['searchAButton'])){
				if(isset($_SESSION['cartCustomerID'])){
					findPerson($_SESSION['cartCustomerID'],true);
				}
				findArticle($_POST['searchA'], true);
				displayCart();
			}

			if(isset($_POST['addCart'])){
				findPerson($_SESSION['cartCustomerID'], true);
				findArticle($pos,true);

				addCart($pos, $_POST['QTY']);
				displayCart();
			}

			if(isset($_POST['removeCart']) && isset($_POST['cartQTY'])){

				findPerson($_SESSION['cartCustomerID'], true);
				removeCart($_POST['cartID'], $_POST['cartQTY']);
				echo "<br />";
				echo "<br />";
				


				echo "<br />";
				echo "<br />";


				echo "removeCart(".$_POST['cartID'].", $_POST[QTY])";
				displayCart();
			}


		?>

	</form>
</div>