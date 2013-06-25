<div>
<?php
	displayInvoiceSearchBar();
	if(isset($_POST['search']) && isset($_POST['searchButton'])){
		findInvoices($_POST['search'],true);
	}

	foreach($_POST as $key => $value) {
		$invoiceIDCreated = strpos($key , "generateInvoice_");
				  //$posQTY = strpos($key, "addQTY_".$posID);

		if ($invoiceIDCreated === 0){
			$createID=substr($key,16);
			$_SESSION['invoiceID']=$createID;
			$createIDString = "order-" . $createID ."-2013";
		//	echo $createIDString;
		  // echo "id: ".$articleID. "<br />" . "qty: " .$QTY;
		  
	 	}
	 	
		//$displayPDFClicked = strpos($key, "showPDF_");
		//if($displayPDFClicked === 0) {
		//	echo "key: " . $key;
		//	$clickID = substr($key, 8);
		//	echo "Click: " . $clickID;
		//	displayInvoice($clickID);
		//}

	}
	
	if(isset($_GET['action']) && $_GET['action'] === "createPDF"){
		//if($_POST['pushedButton'] == 'generateInvoice') {
	
			$orderID = saveInvoiceToDatabase($createIDString);

			if(true) {
				displayInvoice($orderID);
			}
		//}else { //if($_POST['pushedButton'] == 'showPDF') {
		//	displayInvoice($clickID);	
		//}
	}
	

	function displayInvoice($orderID) {
		//echo "orderid: " .$orderID . "<br>";
		echo '<script type="text/javascript">
			window.open("content/AngebotPDF.php?createPDF=Invoice&orderId='.$orderID.'");
		</script>';
	}
?>
</div>