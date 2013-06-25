<div>
<?php
	displayOfferSearchBar();
	if(isset($_POST['search']) && isset($_POST['searchButton'])){
		findOffers($_POST['search'],true);
	}

	foreach($_POST as $key => $value) {
		$orderIDCreated = strpos($key , "generateOrder_");
				  //$posQTY = strpos($key, "addQTY_".$posID);

		if ($orderIDCreated === 0){
			$createID=substr($key,14);
			$_SESSION['orderID']=$createID;
			$createIDString = "generateOrder_" . $createID;
		  // echo "id: ".$articleID. "<br />" . "qty: " .$QTY;
	 	}
	}

	if(isset($_GET['action']) && $_GET['action'] === "createPDF"){
			$orderID = saveOrderToDatabase($createID);

			if(true) {
				echo '<script type="text/javascript">
					window.open("content/AngebotPDF.php?createPDF=Order&orderId='.$orderID.'");
				</script>';
			}	
	}
?>
</div>