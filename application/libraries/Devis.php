<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');

class Devis extends FPDF {
    function Header()
    {
        // Police Arial gras 15
        $this->SetFont('Arial','B',18);
        // Décalage à droite
        $this->Cell(65);
        // Titre
        $this->Cell(30,10,'Devis',0,0,'L');
        // Saut de ligne
        $this->Ln(25);
        $this->SetFont('Arial','',11);
    }

    function table_livraison($header, $data, $data1){
        // Largeurs des colonnes
        $w = array(15, 90, 25, 28, 32);
        // En-t�te
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Donn�es
        foreach($data as $detail)
        {
            $this->Cell($w[0],6,$detail['code_st'],'LR');
            $this->Cell($w[1],6,$detail['designation'],'LR');
            $this->Cell($w[2],6,number_format($detail['pu'],2,',',' '),'LR',0,'R');
            $this->Cell($w[3],6,number_format($detail['qte'],2,',',' '),'LR',0,'R');
            $this->Cell($w[4],6,number_format($detail['montant'],2,',',' '),'LR',0,'R');
            $this->Ln();
        }
            $this->Cell($w[0],6,' ','LR');
            $this->Cell($w[1],6,' ','LR');
            $this->Cell($w[2],6,' ','LR',0,'R');
            $this->Cell($w[3],6,' ','LR',0,'R');
            $this->Cell($w[4],6,' ','LR',0,'R');
            $this->Ln();
            
            $this->Cell($w[0],6,' ','LR');
            $this->Cell($w[1],6,' ','LR');
            $this->Cell($w[2],6,' ','LR',0,'R');
            $this->Cell($w[3],6,'Montant','LR',0,'R');
            $this->Cell($w[4],6,number_format($data1->montant,2,',',' '),'LR',0,'R');
            $this->Ln();

            $this->Cell($w[0],6,' ','LR');
            $this->Cell($w[1],6,' ','LR');
            $this->Cell($w[2],6,'Finition :','LR',0,'R');
            $this->Cell($w[3],6,$data1->finition,'LR',0,'R');
            $this->Cell($w[4],6,number_format($data1->pourcentage,2,',',' '),'LR',0,'R');
            $this->Ln();

            $this->Cell($w[0],6,' ','LR');
            $this->Cell($w[1],6,' ','LR');
            $this->Cell($w[2],6,' ','LR',0,'R');
            $this->Cell($w[3],6,'Montant Total','LR',0,'R');
            $this->Cell($w[4],6,number_format($data1->montant_total,2,',',' '),'LR',0,'R');
            $this->Ln();
        
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }
}

?>