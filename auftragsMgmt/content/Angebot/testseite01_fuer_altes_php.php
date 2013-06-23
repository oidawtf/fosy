<?php
/* ACHTUNG: darf kein einziges Leerzeichen vor phpstart sein, wegen header !!! */
error_reporting(E_ALL);

// FPDF-Zeugs und die spezielle TwPdf-Klasse includen
define("FPDF_FONTPATH","fpdf16/font/");
include_once('fpdf16/fpdf.php');

include_once("twpdf/Testklasse01_fuer_altes_php.php");

// pdf erzeugen
$pdf = new Testklasse01_fuer_altes_php();  

// pdf ausgeben (im Browser oder in Datei schreiben)
$pdf->Output();   // Ausgabe (wenn in Datei schreiben, dateiname in Klammer)
// ACHTUNG: in der aufgerufenen Klasse darf kein Leerzeichen hinter phpende sein!!!
?>