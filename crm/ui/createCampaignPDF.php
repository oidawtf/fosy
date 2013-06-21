<?php

require_once '../../shared/authenticationController.php';
require_once '../includes.php';
require_once '../../shared/fpdf/fpdf.php';

authenticationController::checkAuthentication();
authenticationController::checkAuthorization('createCampaignPDF');

if (!isset($_GET['campaignId']) || !isset($_GET['customerId']))
    return;

$campaignId = $_GET['campaignId'];
$customerId = $_GET['customerId'];

$campaign = controller::getCampaign($campaignId);
$customer = controller::getCustomer($customerId);
$articles = controller::getSelectedArticles($campaignId);

class PDF extends FPDF
{
    const HEADERFONTFAMILY = "Arial";
    const HEADERFONTWEIGHT = "B";
    const HEADERFONTSIZE = 16;
    
    const NORMALFONTFAMILY = "Arial";
    const NORMALFONTWEIGHT = "";
    const NORMALFONTSIZE = 14;
    
    const LEFTINDENT = 10;
    const RIGHTINDENT = 100;
    
    // Page header
    public function Header()
    {
        // Logo
        $this->Image('../../img/logo_120x40_transparent.png', 20, 10, 40);
        $this->Ln(20);
    }
    
    public function PrintCompanyAddress() {
        $this->SetFont('Arial', 'B', 12);
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,10,'Felix Martin Hi-Fi und Videostudios',0,0,'R');
        $this->Ln();

        $this->SetFont('Arial', '', 12);
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,5,'Neubaugasse 15',0,0,'R');
        $this->Ln();
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,5,'1060 Vienna',0,0,'R');
        $this->Ln();
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,6,'Tel.: +43 (1) 213-57-82',0,0,'R');
        $this->Ln();
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,6,'email.: info@felixmartin.at',0,0,'R');
        $this->Ln();
        
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,6,'http://www.felixmartin.at',0,0,'R');
        $this->Ln();
    }
    
    public function PrintCustomerAddress($customer) {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,10,$customer->getFullName(),0,0,'L');
        $this->Ln();
        
        $this->SetFont('Arial', '', 12);
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,5,$customer->getAddress(),0,0,'L');
        $this->Ln();
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,5,$customer->zip." ".$customer->city,0,0,'L');
        $this->Ln();
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,5,$customer->country,0,0,'L');
        $this->Ln();
    }
    
    public function PrintDate() {
        $this->Ln(20);
        $this->SetFont('Arial', '', 12);
        $this->Cell(self::RIGHTINDENT);
        $this->Cell(80,5,"Wien, am ".date("d. m. Y"),0,0,'R');
    }
    
    public function PrintSubject($campaign) {
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 12);
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,20,"Betreff: Interessante Angebote bei Felix Martin Hi-Fi!",0,0,'L');
        $this->Ln();
    }
    
    public function PrintText($campaign) {
        $this->SetFont('Arial', '', 12);
        
        $this->Cell(self::LEFTINDENT);
        $this->MultiCell(170, 5, $campaign->description);
        $this->Ln();
        
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,20,"Hochachtungsvoll");
        $this->Ln(30);
        $this->Cell(self::LEFTINDENT);
        $this->Cell(80,20,"Hr. Felix Martin");
        $this->Ln();
    }

    // Page footer
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
    public function PrintArticle($article) {
        $this->Ln(10);
        $this->Cell(self::LEFTINDENT);
        $this->SetFont(self::HEADERFONTFAMILY, self::HEADERFONTWEIGHT, self::HEADERFONTSIZE);
        $this->Cell(40,10, $article->getFullName()." - EUR ".$article->real_price * (($article->tax_rate / 100) + 1));
        $this->Ln();
        
        $this->SetFont(self::NORMALFONTFAMILY, self::NORMALFONTWEIGHT, self::NORMALFONTSIZE);
        
        $this->Cell(self::LEFTINDENT);
        $this->MultiCell(170, 5, $article->description);
        $this->Ln();
    }
}

// Instanciation of inherited class
$pdf = new PDF();

$pdf->AliasNbPages();

$pdf->Addpage();
$pdf->PrintCompanyAddress();
$pdf->PrintCustomerAddress($customer);
$pdf->PrintDate();
$pdf->PrintSubject($campaign);
$pdf->PrintText($campaign);

$pdf->AddPage();
$pdf->SetFont($pdf::HEADERFONTFAMILY, $pdf::HEADERFONTWEIGHT, $pdf::HEADERFONTSIZE);

$pdf->Cell($pdf::LEFTINDENT);
$pdf->Cell(80,10, "Angebotene Artikel");
foreach ($articles as $article)
    $pdf->PrintArticle($article);

$pdf->Output();
?>
