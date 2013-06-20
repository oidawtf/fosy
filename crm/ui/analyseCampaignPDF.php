<?php

require_once '../../shared/authenticationController.php';
require_once '../includes.php';
require_once '../../shared/fpdf/fpdf.php';

authenticationController::checkAuthentication();
authenticationController::checkAuthorization('analyseCampaignPDF');

if (!isset($_GET['campaignId']))
    return;

$campaignId = $_GET['campaignId'];

$campaign = controller::getCampaignData($campaignId);

class PDF extends FPDF
{
    const HEADERFONTFAMILY = "Arial";
    const HEADERFONTWEIGHT = "B";
    const HEADERFONTSIZE = 16;
    
    const NORMALFONTFAMILY = "Arial";
    const NORMALFONTWEIGHT = "";
    const NORMALFONTSIZE = 14;
    
    public function PrintCustomers($customers) {
        foreach ($customers as $item) {
            $customer = $item['person'];
            $this->SetFont(self::HEADERFONTFAMILY, self::HEADERFONTWEIGHT, self::HEADERFONTSIZE);
            $this->Cell(40,10, "Kunde ".$customer->id." - ".$customer->getFullName());
            $this->Ln();

            $this->PrintArticles($item['articles']);
            $this->Ln();
        }
        
        $this->Ln();
    }
    
    public function PrintArticles($articles) {
        $header = array('Id', 'Name', 'Lager', 'Preis in EUR', 'Anzahl', 'Summe');
        $data = array();
        $sum = 0;
        foreach ($articles as $article) {
            $articleSum = $article->real_price * (($article->tax_rate / 100) + 1) * $article->count;
            $item = array(
                $article->id,
                $article->getFullName(),
                $article->stock,
                $article->real_price,
                $article->count,
                $articleSum
                    );
            $data[] = $item;
            $sum += $articleSum;
        }
        
        $this->PrintArticleTable($header, $data);
        
        $this->Cell(40, 10, "Gesamtumsatz");
        $this->Cell(200, 10, $sum);
    }

    // Colored table
    private function PrintArticleTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFont(self::NORMALFONTFAMILY, self::NORMALFONTWEIGHT, self::NORMALFONTSIZE);
        $this->SetFillColor(76, 150, 224);
        $this->SetTextColor(33, 66, 99);
        $this->SetDrawColor(33, 66, 99);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(10, 70, 20, 35, 20, 35);
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
            $this->Cell($w[4],6,number_format($row[4]),'LR',0,'R',$fill);
            $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln();
    }
}

$pdf = new PDF();

$pdf->AddPage();

$pdf->SetFont($pdf::HEADERFONTFAMILY, $pdf::HEADERFONTWEIGHT, $pdf::HEADERFONTSIZE);
$pdf->Cell(40,10, "Auswertung Kampagne - ".$campaign->id);
$pdf->Ln();
$pdf->Ln();

$pdf->PrintCustomers($campaign->customers);
$pdf->SetFont($pdf::HEADERFONTFAMILY, $pdf::HEADERFONTWEIGHT, $pdf::HEADERFONTSIZE);
$pdf->Cell(40,10, "Bestellte Artikel");
$pdf->Ln();
$pdf->PrintArticles($campaign->articles);

$pdf->Output();

?>
