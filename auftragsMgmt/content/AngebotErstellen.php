<?php
	echo '<pre>'; var_dump($_POST); echo '</pre>';  		
?>

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
			foreach($_POST as $key => $value) {
			  $articleIDadded = strpos($key , "addCart_");
			  //$posQTY = strpos($key, "addQTY_".$posID);

			  if ($articleIDadded === 0){
			    $articleID=substr($key,8);
			  	$QTY = $_POST['addQTY_'.$articleID.''];//"addQTY_".$posID;

			  // echo "id: ".$articleID. "<br />" . "qty: " .$QTY;
			  }
			}

			//<input class=\"quantity\" type=\"number\" name=\"deleteQTY_{$row['id']}\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
			//<input class=\"addButton\" type=\"submit\" name=\"removeCartID_{$row['id']}\" value=\"-\"/>

		
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

			$clickedAdd = "addCart_" . $articleID;

			if(isset($_POST[$clickedAdd])){
				findPerson($_SESSION['cartCustomerID'], true);
				findArticle($articleID,true);
				addCart($articleID, $QTY);
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