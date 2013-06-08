<?php
require('fpdf/fpdf.php');

function createCustomerPDF($pCustomer){
	findPerson($pCustomer);
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,'hello, i am a pdf!!');
	$pdf->Output();
}
?>