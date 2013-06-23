<?php

// unsere Testklasse erbt von der FPDF-Klasse
class Testklasse01 extends FPDF {
	
	// hier werden die Variablen für diese Klasse deklariert (also: "bekanntgemacht")
	private $twVariable01 = "";
	private $twVariable02 = ""; 
	
	
	// der Konstruktor dieser Klasse
	function __construct() {
		// Konstruktor der vererbenden Klasse aufrufen (also den von FPDF)
		parent::__construct("P", "mm", "A4"); // L=Querformat(Landscape), P=Hochformat(Portrait)
		
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
		$this->SetFont("Arial","B","16");                    // Schrift
		$this->SetTextColor(255, 000, 000);                  // Schriftfarbe
		$this->SetXY(20, 50);                                // Position                
		$this->Cell(90, 10, $this->twVariable01, 1, 1, "L"); // Box(Textbox)
	}	
	
	
	function Footer() {		
		// Farben und Schrift allgemein
		$this->SetFont("Courier","I","9");    
		$this->SetTextColor(180);             
		$this->SetXY(25, 288); 
		$this->Cell(170, 5, "dieses Dokument wurde am ". $this->twVariable02. " erstellt", 1, 1, "R");  
	}	
}
/* ACHTUNG: darf kein einziges Leerzeichen hinter phpend sein (wegen header) !!! */
?>