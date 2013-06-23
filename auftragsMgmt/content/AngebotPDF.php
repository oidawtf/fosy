<?php session_start(); 

	require("../../shared/authenticationController.php");
	require('../../shared/fpdf.php');
	require('../../shared/fpdm.php');
	require('../../shared/font/helvetica.php');
	require('../../shared/font/helveticab.php');
	require('../../shared/font/helveticabi.php');
	require('../../shared/font/helveticai.php');
	require('../util/db.inc.php');
	require('../util/functions.inc.php');
	require('../util/pdf.class.php');

	
	$customerId = $_SESSION['cartCustomerID'];
	$articles = $_SESSION['cart'];
	$deliveryAddress = $_SESSION['deliveryAddress'];
	$paymentMethod = $_SESSION['paymentMethod']['Zahlart'];
	$montage = $_SESSION['paymentMethod']['Montage'];
	$offerId = '1'; // TODO i need the offer id!!! $_SESSION['offerID'];

	//echo "customId: " . $customerId . "<br>";
	/*$i = 0;
	foreach($articles as $article) {
		echo "articleId: " . $article[$i] . "<br>";
		$i++;
	}
	foreach($deliveryAddress as $delAdd) {
		echo "delAdd: " . $delAdd . "<br>";
	}
	echo "paymentMethod: " . $paymentMethod . "<br>";
	echo "montage: " . $montage . "<br>";
	*/
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	// COMPANY BLOCK
	$pdf->createCompanyBlock();
	
	// CUSTOMER BLOCK	
	$customer = array();
	$customerResult = findPerson($customerId, false);
	while($row = mysql_fetch_assoc($customerResult)){
		array_push($customer, $row);
	}
	$customerAddressResult = findPersonAddress($customerId);
	while($row = mysql_fetch_assoc($customerAddressResult)) {
		array_push($customer, $row);
	}
	$pdf->createCustomerBlock($customer);
	
	// DATE AND OFFERNUMBER
	$offer = array();
	$offerResult = findOffer($offerId);
	while($row = mysql_fetch_assoc($offerResult)) {
		array_push($offer, $row);
	}
	//var_dump($offer);
	$pdf->createDateAndOfferNumber($offer);
	
	
	// TITLE + TEXT
	$pdf->createTitleAndText();
	
	// ARTICLE TABLE
	// TODO
	$pdf->createArticleTable();
	
	// BOTTOM TEXT
	$pdf->createBottomText($offer);
	
	// GENERATE THE PDF AND OFFER TO OPEN
	$filename = $offer[0]['number'].'.pdf'; // TODO use the var name
	$pdf->Output($filename, 'D');
	
	
?>
