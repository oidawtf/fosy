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

	/*var_dump($_SESSION);*/
	//var_dump($_GET);
	
	$pdfType = $_GET['createPDF'];
	
	if($pdfType == 'Offer') {
		$offerId = $_GET['offerId'];
		$customerId = $_SESSION['cartCustomerID'];
		$articles = $_SESSION['cart'];
		$deliveryAddress = $_SESSION['deliveryAddress'];
		$paymentMethod = $_SESSION['paymentMethod']['Zahlart'];
		$montage = $_SESSION['paymentMethod']['Montage'];
	
		$offer = array();
		$offerResult = findOffer($offerId);
		while($row = mysql_fetch_assoc($offerResult)) {
			array_push($offer, $row);
		}
			
	}else if( ($pdfType == 'Order') || ($pdfType == 'Invoice')) {
		$orderId = $_GET['orderId'];
		//		echo "orderId: " . $orderId . "<br>";
		$customerId = findCustomerId($orderId);
		$articles = findArticlesWithQuantityForOrder($orderId);
		$deliveryAddress = findDeliveryAddressForOrder($orderId);
		$montage = findMontageByOrder($orderId);
			
		/*var_dump($customerId);
		echo "<br>";
		var_dump($_SESSION['cartCustomerID']);*/
		
		$order = array();
		$orderResult = findOrders($orderId);
		while($row = mysql_fetch_assoc($orderResult)) {
			array_push($order, $row);
		}
		
	}
		
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
	//var_dump($offer);
	if($pdfType == 'Offer') {
		$number = "Angebot-Nr: ".$offer[0]['number'];
	} else if($pdfType == 'Order') {
		$number = "Auftrags-Nr: " .$order[0]['number'];
	}else if($pdfType == 'Invoice') {
		$number = "Rechnungs-Nr: AR" . $order[0]['number'];
	}
	
	$pdf->createDateAndOfferNumber($number);
		
	
	// TITLE + TEXT
	if($pdfType == 'Offer') {
		$title = "Angebot";
		$text = "Nachfolgend finden Sie das gewünschte Angebot.";
	} else if($pdfType == 'Order') {
		$title = "Auftrag";
		$text = "Nachfolgend finden Sie die Positionen Ihres Auftrags.";
	}else if($pdfType == 'Invoice') {
		$title = "Rechnung";
		$text = "Nachfolgend finden Sie die Positionen Ihrer Rechnung.";
	}
	$pdf->createTitleAndText($title, $text);
	
	// ARTICLE TABLE
	$articleList = array();
	foreach($articles as $articleId => $quantity) {
		$article = findArticleById($articleId, false);
		while($row = mysql_fetch_assoc($article)){
			$row['quantity'] = $quantity;
			array_push($articleList, $row);
		}
	}
	$pdf->createArticleTable($articleList);
	
	// DELIVERY ADDRESS
	$pdf->createDeliveryAddress($deliveryAddress);
	
	// MONTAGE
	$pdf->createMontage($montage);
	
	// PAYMENT METHOD
	if($pdfType=='Offer') {
		$pdf->createPaymentMethod($paymentMethod);
	}
	
	// BOTTOM TEXT OFFER/ORDER/INVOICE
	if($pdfType == 'Offer') {
		$pdf->createBottomTextOffer($offer);
	}else if($pdfType == 'Order') {
		$pdf->createBottomTextOrder();
	}else if($pdfType == 'Invoice') {
		$pdf->createBottomTextInvoice();
	}
	
	// GENERATE GREETINGS LINES
	$pdf->createGreetings();
	
	// GENERATE THE PDF AND OFFER TO OPEN
	if($pdfType == 'Offer') {
		$filename = $offer[0]['number'].'.pdf';
	} else if($pdfType == 'Order') {
		$filename = $order[0]['number'].'.pdf';
	}else if($pdfType == 'Invoice') {
		$filename = $order[0]['number'].'.pdf';
	}
	
	$pdf->Output($filename, 'D');
	
	// TODO
	clearCart();
	
//function hex2dec
//returns an associative array (keys: R,G,B) from
//a hex html code (e.g. #3FE5AA)
function hex2dec($color = "#000000"){
	$R = substr($color, 1, 2);
	$red = hexdec($R);
	$V = substr($color, 3, 2);
	$green = hexdec($V);
	$B = substr($color, 5, 2);
	$blue = hexdec($B);
	$tbl_color = array();
	$tbl_color['R']=$red;
	$tbl_color['G']=$green;
	$tbl_color['B']=$blue;
	return $tbl_color;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px){
	return $px*25.4/72;
}

function txtentities($html){
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans = array_flip($trans);
	return strtr($html, $trans);
}
	
?>
