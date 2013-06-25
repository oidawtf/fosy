<?php
	require('datefunctions.inc.php');
	require('numberFunctions.inc.php');
	
class PDF extends FPDF {

	var $B;
	var $I;
	var $U;
	var $HREF;
	var $fontList;
	var $issetfont;
	var $issetcolor;

	function PDF($orientation='P', $unit='mm', $format='A4') {
		//Call parent constructor
		$this->FPDF($orientation,$unit,$format);
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';

		$this->tableborder=0;
		$this->tdbegin=false;
		$this->tdwidth=0;
		$this->tdheight=0;
		$this->tdalign="L";
		$this->tdbgcolor=false;

		$this->oldx=0;
		$this->oldy=0;

		$this->fontlist=array("Helvetica");
		$this->issetfont=false;
		$this->issetcolor=false;
	}

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
		
		if(strlen($customer[1]['stiege']) > 0) {
			$address .= "/".$customer[1]['stiege'];
		}
		if(strlen($customer[1]['doornumber']) > 0) {
			$address .= "/".$customer[1]['doornumber'];
		}
		$this->Cell(0, 5, $address, 0, 2);
		$this->Cell(0, 5, $customer[1]['zip']." ".utf8_decode($customer[1]['city']), 0, 2);
		$this->Cell(0, 5, utf8_decode($customer[1]['country']), 0, 2);
	}
	
	function createDateAndOfferNumber($number) {
		$this->SetXY(-80, 70);
		$curdate = date("d.m.Y");
		$this->Cell(0, 5, "Datum: ".$curdate, 0, 2);
		$this->Cell(0, 5, $number, 0, 2);
	}
	
	function createTitleAndText($title, $text) {
		$this->SetXY(15, 80);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 10, $title, 0, 2);
		$this->SetFont('Helvetica', '', 12);
		$str = utf8_decode($text);
		$this->Cell(0, 10, $str, 0, 2);
	}
	
	function createArticleTable($articleList) {
		$this->SetFont('Helvetica', 'B', 12);

		$html='<table border="1">
				<tr>
					<td width="50" height="30" bgcolor="#D0D0FF">Pos.</td>
					<td width="300" height="30" bgcolor="#D0D0FF">Bezeichnung/Modell</td>
					<td width="45" height="30" bgcolor="#D0D0FF">Ust.</td>
					<td width="60" height="30" bgcolor="#D0D0FF">Menge</td>
					<td width="120" height="30" bgcolor="#D0D0FF">Preis in EUR</td>
					<td width="140" height="30" bgcolor="#D0D0FF">Gesamt in EUR</td>
				</tr>';
		
		$i = 1;
		$gesamtSummeBrutto = 0;
		$gesamtSummeSteuer = 0; 
		foreach($articleList as $article) {
			
			$sum = floatval($article['selling_price'] * $article['quantity']);
					
			if($article['tax_rate']==10) { (float)$gesamtSummeSteuer += ($article['selling_price'] / 11); }
			else if($article['tax_rate']==20) { (float)$gesamtSummeSteuer += ($article['selling_price'] / 6); }
			
			$gesamtSummeSteuer = round($gesamtSummeSteuer, 2);
			
			$dotPos = strrpos($sum, '.');
			if($dotPos === false) { $sum .= '.00'; }
			
			$gesamtSummeBrutto += $sum;
			
			$html .= '<tr>
					<td width="50" height="30">'.$i.'</td>
					<td width="300" height="30">'.$article['model'].'</td>
					<td width="45" height="30" ALIGN="RIGHT">'.$article['tax_rate'].' %</td>
					<td width="60" height="30" ALIGN="RIGHT">'.$article['quantity'].'</td>
					<td width="120" height="30" ALIGN="RIGHT">'.str_replace('.', ',', $article['selling_price']).'</td>
					<td width="140" height="30" ALIGN="RIGHT">'.str_replace('.', ',', $sum).'</td>
				</tr>';
			$i++;
		}
		
		$html .= '</table>';
		
		utf8_decode($html);
		$this->WriteHTML($html);
		
		$this->Ln(5);
		$this->SetX(-70);
		
		$this->SetFont('Helvetica', '', 12);

		$dotPos1 = strrpos($gesamtSummeBrutto, '.');
		if($dotPos1 === false) { $gesamtSummeBrutto .= '.00'; }
		$this->Cell(20, 5, 'Summe: ', 'B', 0, 'R');
		$this->Cell(34, 5, str_replace('.', ',', $gesamtSummeBrutto).' EUR', 'B', 2, 'R');
		$this->Cell(0, 5, '', 0, 2);
		
		$netto = $gesamtSummeBrutto - $gesamtSummeSteuer;
		$dotPos2 = strrpos($netto, '.');
		if($dotPos2 === false) { $netto .= '.00'; }
		$this->SetX(-70);
		$this->Cell(20, 5, 'Netto: ', 'B', 0, 'R');
		$this->Cell(34, 5, str_replace('.', ',', $netto).' EUR', 'B', 2, 'R');

		
		$dotPos3 = strrpos($gesamtSummeSteuer, '.');
		if($dotPos3 === false) { $gesamtSummeSteuer .= '.00'; }
		$this->SetX(-70);
		$this->Cell(20, 5, 'Ust: ', 'B', 0, 'R');
		$this->Cell(34, 5, str_replace('.', ',', $gesamtSummeSteuer).' EUR', 'B', 2, 'R');
		
		
		$dotPos4 = strrpos($gesamtSummeBrutto, '.');
		if($dotPos4 === false) { $gesamtSummeBrutto .= '.00'; }
		$this->SetX(-70);
		$this->SetFont('Helvetica', 'B', 12);		
		$this->Cell(20, 5, 'Brutto: ', 'B', 0, 'R');
		$this->Cell(34, 5, str_replace('.', ',', $gesamtSummeBrutto).' EUR', 'B', 2, 'R');		
		
	}
	
	function createDeliveryAddress($deliveryAddress) {
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 5, 'Lieferadresse:', 0, 2);
		$this->SetFont('Helvetica', '', 12);
		
		$address = utf8_decode($deliveryAddress['strasse'])." ".$deliveryAddress['hausnummer'];
		
		if(strlen($deliveryAddress['stiege']) > 0) {
			$address .= "/".$deliveryAddress['stiege'];
		}
		if(strlen($deliveryAddress['doornum']) > 0) {
			$address .= "/".$deliveryAddress['doornum'];
		}
		$this->Cell(0, 5, $address, 0, 2);
		$this->Cell(0, 5, $deliveryAddress['zip']." ".utf8_decode($deliveryAddress['stadt']), 0, 2);
		$this->Cell(0, 5, utf8_decode($deliveryAddress['land']), 0, 2);
	}
	
	function createMontage($montage) {
		if($montage == 1) {
			$this->Cell(0, 10, '', 0, 2);
			$this->SetFont('Helvetica', 'B', 12);
			$this->Cell(0, 5, 'Montage:', 0, 2);
			$this->SetFont('Helvetica', '', 12);
			$this->Cell(0, 5, 'Eine Montage wurde vereinbart.', 0, 2);
		}
	}
	
	function createPaymentMethod($paymentMethod) {
		$this->Cell(0, 10, '', 0, 2);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(0, 5, 'Zahlungsart:', 0, 2);
		$this->SetFont('Helvetica', '', 12);
		$str = utf8_decode('Die gewünschte Zahlungsart ist "'.$paymentMethod.'".');
		$this->Cell(0, 5, $str, 0, 2);
	}
	
	// entweder offer
	function createBottomTextOffer($offer) {
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Helvetica', '', 12);
		$str1 = utf8_decode("Wir würden uns freuen Ihren Auftrag zu erhalten. Bei Fragen zögern Sie nicht uns zu kontaktieren.");
		$this->Cell(0, 10, $str1, 0, 2);
		$str2 = utf8_decode("Das Angebot ist gültig von ".formatDateForOutput($offer[0]['valid_from'])." bis ".formatDateForOutput($offer[0]['valid_until']).".");
		$this->Cell(0, 10, $str2, 0, 2);
	}
	
	// oder order
	function createBottomTextOrder() {
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Helvetica', '', 12);
		$str1 = utf8_decode("Wir danken Ihnen für Ihren Auftrag.");
		$this->Cell(0, 10, $str1, 0, 2);
	}
	
	// oder invoice
	function createBottomTextInvoice() {
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Helvetica', '', 12);
		$str1 = utf8_decode("Bitte begleichen Sie den offenen Betrag innerhalb von 14 Tagen.");
		$this->Cell(0, 10, $str1, 0, 2);
	}
	
	function createGreetings() {
		$str3 = utf8_decode("Mit freundlichen Grüßen");
		$this->Cell(0, 10, $str3, 0, 2);
		$this->Cell(0, 5, "Felix Martin", 0, 2);
	}
	
	function WriteHTML($html) {
		//remove all unsupported tags
		$html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); 
		$html=str_replace("\n",'',$html); //replace carriage returns by spaces
		$html=str_replace("\t",'',$html); //replace carriage returns by spaces
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explodes the string
		
		foreach($a as $i=>$e) {
			if($i%2==0) {
				//Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				elseif($this->tdbegin) {
					if(trim($e)!='' && $e!="&nbsp;") {
						$this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
					} elseif($e=="&nbsp;") {
						$this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
					}
				} else
					$this->Write(5,stripslashes(txtentities($e)));
			} else {
				//Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else {
					//Extract attributes
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$attr=array();
					foreach($a2 as $v) {
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}

	function OpenTag($tag, $attr) {
		//Opening tag
		switch($tag) {

			case 'SUP':
				if( !empty($attr['SUP']) ) {    
					//Set current font to 6pt     
					$this->SetFont('','',6);
					//Start 125cm plus width of cell to the right of left margin         
					//Superscript "1" 
					$this->Cell(2,2,$attr['SUP'],0,2,'L');
				}
				break;

			case 'TABLE': // TABLE-BEGIN
				if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
				else $this->tableborder=0;
				break;
			case 'TR': //TR-BEGIN
				break;
			case 'TD': // TD-BEGIN
				if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
				else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
				if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
				else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
				if( !empty($attr['ALIGN']) ) {
					$align=$attr['ALIGN'];        
					if($align=='LEFT') $this->tdalign='L';
					if($align=='CENTER') $this->tdalign='C';
					if($align=='RIGHT') $this->tdalign='R';
				} else 
					$this->tdalign='L'; // Set to your own
				if( !empty($attr['BGCOLOR']) ) {
					$coul=hex2dec($attr['BGCOLOR']);
					$this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
					$this->tdbgcolor=true;
				}
				$this->tdbegin=true;
				break;
			case 'HR':
				if( !empty($attr['WIDTH']) )
					$Width = $attr['WIDTH'];
				else
					$Width = $this->w - $this->lMargin-$this->rMargin;
				$x = $this->GetX();
				$y = $this->GetY();
				$this->SetLineWidth(0.2);
				$this->Line($x,$y,$x+$Width,$y);
				$this->SetLineWidth(0.2);
				$this->Ln(1);
				break;
			case 'STRONG':
				$this->SetStyle('B',true);
				break;
			case 'EM':
				$this->SetStyle('I',true);
				break;
			case 'B':
			case 'I':
			case 'U':
				$this->SetStyle($tag,true);
				break;
			case 'A':
				$this->HREF=$attr['HREF'];
				break;
			case 'IMG':
				if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
					if(!isset($attr['WIDTH']))
						$attr['WIDTH'] = 0;
					if(!isset($attr['HEIGHT']))
						$attr['HEIGHT'] = 0;
					$this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
				}
				break;
			case 'BLOCKQUOTE':
			case 'BR':
				$this->Ln(5);
				break;
			case 'P':
				$this->Ln(10);
				break;
			case 'FONT':
				if (isset($attr['COLOR']) && $attr['COLOR']!='') {
					$coul=hex2dec($attr['COLOR']);
					$this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
					$this->issetcolor=true;
				}
				if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
					$this->SetFont(strtolower($attr['FACE']));
					$this->issetfont=true;
				}
				if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
					$this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
					$this->issetfont=true;
				}
				break;
			
		}
	}
	
	function CloseTag($tag) {
		//Closing tag
		if($tag=='SUP') {
		}

		if($tag=='TD') { // TD-END
			$this->tdbegin=false;
			$this->tdwidth=0;
			$this->tdheight=0;
			$this->tdalign="L";
			$this->tdbgcolor=false;
		}
		if($tag=='TR') { // TR-END
			$this->Ln();
			$this->SetX(15);
		}
		if($tag=='TABLE') { // TABLE-END
			//$this->Ln();
			$this->tableborder=0;
		}

		if($tag=='STRONG')
			$tag='B';
		if($tag=='EM')
			$tag='I';
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF='';
		if($tag=='FONT'){
			if ($this->issetcolor==true) {
				$this->SetTextColor(0);
			}
			if ($this->issetfont) {
				$this->SetFont('Helvetica');
 				$this->issetfont=false;
			}
		}
	}
	
	function SetStyle($tag, $enable) {
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s) {
			if($this->$s>0)
				$style.=$s;
    	}
		$this->SetFont('',$style);
	}

	function PutLink($URL, $txt) {
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}

} // class end
?>