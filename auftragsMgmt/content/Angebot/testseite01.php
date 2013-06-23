<?php
// ACHTUNG: darf kein einziges Leerzeichen vor phpstart sein, wegen header !!!
error_reporting(E_ALL);

// FPDF-Klasse und das Verzeichnis der FPDF-Schriftarten einbinden
define("FPDF_FONTPATH","fpdf16/font/");
include_once('fpdf16/fpdf.php');

// unsere selbsterstellte Testklasse01 einbinden
include_once("twpdf/Testklasse01.php");

// pdf erzeugen (aus unserer selbsterstellten Testklasse01)
$pdf = new Testklasse01();  

// pdf ausgeben (im Browser oder in Datei schreiben)
$pdf->Output();   // Ausgabe (wenn in Datei schreiben, dateiname in Klammer)

// ACHTUNG: in der aufgerufenen Klasse darf kein Leerzeichen hinter phpende sein!!!
?>