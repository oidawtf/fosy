<?php
	//echo '<pre>'; var_dump($_SESSION['cart']); echo '</pre>';  		
?>

<div>	
		<?php
		if(isset($_GET['page']) && $_GET['page'] === 'konditionen'){
			displayConditionPage();
		}
		else if(isset($_GET['page']) && $_GET['page'] === 'CreateOffer'){
			displayCheckOut();
		}
		else if(isset($_GET['action']) && $_GET['action'] === "createPDF"){
			$offerId = saveOfferToDatabase();

			if(true) {
				echo '<script type="text/javascript">
					window.open("content/AngebotPDF.php?createPDF=Offer&offerId='.$offerId.'");
				</script>';
			}
		}
		else
		{
			echo "
				<table>
					<tr>
						<form method=\"POST\" action=\"{$_SERVER["PHP_SELF"]}?content=AngebotErstellen\">
						<td>Kundennummer / Name:</td>
						<td><input type=\"text\" name=\"search\"></td>
						<td><input type=\"submit\" name=\"searchButton\" value=\"suchen\">
					</tr>
				</table>";

				if(!isset($_POST['search']) && !isset($_POST['searchButton']) && !isset($_POST['personSelectDropDown']) && !isset($_POST['personPicker']))
					echo "Noch kein Kunde? <a href=\"http://localhost/fosy/crm/index.php?content=createcustomer&prevPage=true\">Anlegen</a>";
			
				
				if(isset($_SESSION['cartCustomerID']) && !isset($_POST['searchA']) && !isset($_POST['searchAButton'])){
					findPerson($_SESSION['cartCustomerID'], true);
					displayCart(true);
				}


				foreach($_POST as $key => $value) {
					$articleIDadded = strpos($key , "addCart_");
					echo strpos($key , "addCart_");
					$articleDelete = strpos($key, "removeCartID_");
					echo strpos($key, "removeCartID_");
							  //$posQTY = strpos($key, "addQTY_".$posID);
			
					if ($articleIDadded === 0){
						$articleID=substr($key,8);
						$QTY = $_POST['addQTY_'.$articleID.''];//"addQTY_".$posID;
			
							  // echo "id: ".$articleID. "<br />" . "qty: " .$QTY;
					 }
			
					if ($articleDelete === 0){
						$articleDelID=substr($key,13);
						$QTYdel = $_POST['deleteQTY_'.$articleDelID.''];
								  // echo "id: ".$articleID. "<br />" . "qty: " .$QTY;
					}
			
			
			
				}
			
							//<input class=\"quantity\" type=\"number\" name=\"deleteQTY_{$row['id']}\" min=\"0\" max=\"20\" step=\"1\" maxlength=\"2\" value=\"0\"/>
							//<input class=\"addButton\" type=\"submit\" name=\"removeCartID_{$row['id']}\" value=\"-\"/>
			
						
				if(isset($_POST['search']) && isset($_POST['searchButton'])){
					findPerson($_POST['search'],true);
				}
							

			
				if(isset($_POST['personSelectDropDown']) && isset($_POST['personPicker'])){
					findPerson($_POST['personSelectDropDown'],true);
				}
			
				if(isset($_POST['searchA']) && isset($_POST['searchAButton'])){
					if(isset($_SESSION['cartCustomerID'])){
						findPerson($_SESSION['cartCustomerID'],true);
					}
					findArticle($_POST['searchA'], true);
					displayCart(true);
				}
			
				$clickedAdd = "addCart_" . $articleID;
			
				if(isset($_POST[$clickedAdd])){
					findPerson($_SESSION['cartCustomerID'], true);
					findArticle($articleID,true);
					if($QTY > 0){
						addCart($articleID, $QTY);
					}
					displayCart(true);
				}
			
				$clickedDel = "removeCartID_" . $articleDelID;
			
				if(isset($_POST[$clickedDel])){
					findPerson($_SESSION['cartCustomerID'], true);
					//removeCart($_POST['cartID'], $_POST['cartQTY']);

					removeCart($articleDelID, $QTYdel);
					displayCart(true);
				}
			
				if(!cartIsEmpty()){
									//echo "LINKLINKLINK";
					displayConditionsLink();
				}
			}
		?>

	</form>
</div>