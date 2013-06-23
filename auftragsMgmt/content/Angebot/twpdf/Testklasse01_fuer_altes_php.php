<?php

// unsere Testklasse erbt von der FPDF-Klasse
class Testklasse01_fuer_altes_php extends FPDF {
	
	// hier werden die Variablen für diese Klasse deklariert (also: "bekanntgemacht")
	var $twVariable01 = "";
	var $twVariable02 = ""; 
	
	
	// der Konstruktor dieser Klasse
	function Testklasse01_fuer_altes_php() {
		// Konstruktor der vererbenden Klasse aufrufen (also den von FPDF)
		parent::FPDF("P", "mm", "A4"); // L=Querformat(Landscape), P=Hochformat(Portrait)
		
		// hier werden die Variablen dieser Klasse initialisiert (also: "gefüllt")
		$this->twVariable01 = "Hallo, ich bin der Probetext aus Testklasse01";
		$this->twVariable02 = date("d.m.Y");
		
		// Einstellungen für das zu erstellende PDF-Dokument
		$this->SetDisplayMode(100);      // wie groß wird Seite angezeigt(in %)
		
		// Seite erzeugen (sozusagen: starten)
		$this->AddPage(); 
	}
	
	
	
	// eine Funktion zur Anzeige des Inhalts
  function Header() {
    $this->SetFont("Arial","B","16");
		$this->SetTextColor(255, 000, 000);
		$this->SetXY(20, 50);                     
		$this->Cell(90, 10, $this->twVariable01, 1, 1, "L");
	}
	
	
	
	function Footer() {		
		// Farben und Schrift allgemein
		$this->SetFont("Courier","I","9");      // Schrift
		$this->SetTextColor(180);             // Schriftfarbe
		$this->SetXY(25, 288); 
    $this->Cell(170, 5, "dieses Dokument wurde am ". $this->twVariable02. " erstellt", 1, 1, "R");  
	}
	
}
/* ACHTUNG: darf kein einziges Leerzeichen hinter "?>" sein (wegen header) !!! */
?>