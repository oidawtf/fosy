<?php
	require('datefunctions.inc.php');
	
class PDF extends FPDF {
	function Header() {
		$this->Image('../../img/logo_auftragsMgmt.png',10,6,60);
		$this->SetFont('Helvetica','B',15);
		$this->Cell(80);
		$this->Cell(30,10,"Felix Martin Hi-Fi",0,0,'C');
		$this->Ln(5);
		$this->Cell(80);
		$this->cell(30,10,"und Videostudios",0,0,'C');
		$this->Ln(20);
	}
	function Footer() {
    	// Position at 1.5 cm from bottom
		$this->SetY(-15);
		$this->SetFont('Helvetica','',8);
		$this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	function createCompanyBlock() {
		$this->SetXY(-80, 30);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 5, 'Angebot', 0, 2);
		$this->SetFont('Helvetica', '', 12);
		$this->Cell(0, 5, 'Felix Martin Hi-Fi und Videostudios', 0, 2);
		$this->Cell(0, 5, 'Neubaugasse 15, A-1060 Wien', 0, 2);
		$this->Cell(0, 5, 'Tel: +43/1/2135782', 0, 2);
		$this->Cell(0, 5, 'UID: AT1234567', 0, 2);
		$this->SetFont('Helvetica', 'U', 12);
		$this->SetTextColor(0, 0, 255);
		$this->Cell(0, 5, 'auftragsmgmt@felixmartin.at', 0, 2, '', '', 'mailto:auftragsmgmt@felixmartin.at');
		$this->Cell(0, 5, 'http://www.felixmartin.at', 0, 2, '', '', 'http://www.felixmartin.at');
		
	}
	
	function createCustomerBlock($customer) {
		$this->SetXY(15, 40);
		$this->SetFont('Helvetica', '', 12);
		$this->SetTextColor(0, 0, 0);
		$this->Cell(0, 5, utf8_decode($customer[0]['firstname'])." ".utf8_decode($customer[0]['lastname']), 0, 2);
		$address = utf8_decode($customer[1]['street'])." ".$customer[1]['housenumber'];
		
		if(isset($customer[1]['stiege'])) {
			$address .= "/".$customer[1]['stiege'];
		}
		if(isset($customer[1]['doornumber'])) {
			$address .= "/".$customer[1]['doornumber'];
		}
		$this->Cell(0, 5, $address, 0, 2);
		$this->Cell(0, 5, $customer[1]['zip']." ".utf8_decode($customer[1]['city']), 0, 2);
		$this->Cell(0, 5, utf8_decode($customer[1]['country']), 0, 2);
	}
	
	function createDateAndOfferNumber($offer) {
		$this->SetXY(-80, 70);
		$curdate = date("d.m.Y");
		$this->Cell(0, 5, "Datum: ".$curdate, 0, 2);	
		$this->Cell(0, 5, "Angebot: ".$offer[0]['number'], 0, 2);
	}
	
	function createTitleAndText() {
		$this->SetXY(15, 80);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 10, "Angebot", 0, 2);
		$this->SetFont('Helvetica', '', 12);
		$str = utf8_decode("Nachfolgend finden Sie das gewünschte Angebot.");
		$this->Cell(0, 10, $str, 0, 2);
	}
	
	function createArticleTable() {
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 20, 'Hier kommt die Article table rein', 0, 2);
		
	}
	
	function createBottomText($offer) {
		$this->SetFont('Helvetica', '', 12);
		$str1 = utf8_decode("Wir würden uns freuen Ihren Auftrag zu erhalten. Bei Fragen zögern Sie nicht uns zu kontaktieren.");
		$this->Cell(0, 10, $str1, 0, 2);
		$str2 = utf8_decode("Das Angebot ist gültig von ".formatDateForOutput($offer[0]['valid_from'])." bis ".formatDateForOutput($offer[0]['valid_until']).".");
		$this->Cell(0, 10, $str2, 0, 2);
		$str3 = utf8_decode("Mit freundlichen Grüßen");
		$this->Cell(0, 10, $str3, 0, 2);
		$this->Cell(0, 5, "Felix Martin", 0, 2);
	}
	
	/*
		colWidth: 	array(50, 40, ..)
		header: 	array("Anzahl Angebote (KZ)", "Anzahl Aufträge (KZ)", ..)
		data:		array(array(3), array(5), ..)
	*/
	/*function Table($colWidth, $header, $data) {
		// Colors, line width and bold font
		$this->SetFillColor(66,151,215);
		$this->SetTextColor(255);
		$this->SetDrawColor(66,151,215);
		$this->SetLineWidth(.3);
		$this->SetFont('Helvetica','B', 12);

		// Header
		for($i=0; $i<count($colWidth); $i++) {
			$this->Cell($colWidth[$i],7,$header[$i],1,0,'C',true);	
		}
		$this->Ln();
		
		// Color and font restoration
		$this->SetFillColor(208,229,245);
		$this->SetTextColor(0);
		$this->SetFont('Helvetica', '', 12);
		
		// Data
		$fill = false;
		foreach($data as $row) {
			for($i=0; $i<count($colWidth); $i++) {
				$this->Cell($colWidth[$i],6,$row[$i],'LR',0,'R',$fill);
			}
			$this->Ln();
			$fill = !$fill;
		}	

		// Closing line
		$this->Cell(array_sum($colWidth),0,'','T');
	}*/
}
?>