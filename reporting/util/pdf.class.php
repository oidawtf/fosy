<?php

class PDF extends FPDF {
	function Header() {
		$this->Image('../../img/logo_reporting.png',10,6,60);
		$this->SetFont('Helvetica','B',15);
		$this->Cell(80);
		$this->Cell(30,10,"Flexible Report",0,0,'C');
		$this->Ln(20);
	}
	function Footer() {
    	// Position at 1.5 cm from bottom
		$this->SetY(-15);
		$this->SetFont('Helvetica','',8);
		$this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	/*
		colWidth: 	array(50, 40, ..)
		header: 	array("Anzahl Angebote (KZ)", "Anzahl Aufträge (KZ)", ..)
		data:		array(array(3), array(5), ..)
	*/
	function Table($colWidth, $header, $data) {
		// Colors, line width and bold font
		$this->SetFillColor(66,151,215);
		$this->SetTextColor(255);
		$this->SetDrawColor(66,151,215);
		$this->SetLineWidth(.3);
		$this->SetFont('Helvetica','B', 12);

		// Header
		for($i=0; $i<count($colWidth); $i++) {
			$this->Cell($colWidth[$i],7,utf8_decode($header[$i]),1,0,'C',true);	
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
				$this->Cell($colWidth[$i],6,utf8_decode($row[$i]),'LR',0,'R',$fill);
			}
			$this->Ln();
			$fill = !$fill;
		}	

		// Closing line
		$this->Cell(array_sum($colWidth),0,'','T');
	}
}
?>