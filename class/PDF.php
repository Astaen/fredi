<?php
require('/vendor/fpdf.php');

class PDF extends FPDF
{
    // Chargement des données
    function LoadData($file)
    {
        // Lecture des lignes du fichier
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Tableau simple
    function BasicTable($header, $data)
    {
        // En-tête
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Données
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }

    // Tableau amélioré
    function ImprovedTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(40, 35, 45, 40);
        // En-tête
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Données
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R');
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }

    // Tableau coloré
    function FancyTable($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(33,150,243);
        $this->SetTextColor(255);
        $this->SetDrawColor(33,150,243);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

        #region Entête
        $height = 7;

        foreach($header as $head) {
            //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
            $this->Cell($head['width'], $height, $head['content'], 1, 0, 'C',true);
        }
        $this->Ln();
        #endregion

        #region Données
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(10,105,182);
        $this->SetFont('');
        $fill = false;
        foreach($data as $row)
        {
            foreach ($row as $index => $cell) {
                # code...
                $this->Cell($header[$index]['width'], $height, $cell, 1, 0, 'L', $fill);
            }
            $this->Ln();
            $fill = !$fill;
        }
        // Trait de terminaison
        // $this->Cell($width*count($data),0,'','T');
        #endregion
    }

    function Total($total) {
        $this->SetFillColor(33,150,243);
        $this->SetTextColor(255);
        $this->SetDrawColor(33,150,243);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $this->Cell(160, 7, 'Total', 1, 0, 'L', true);
        $this->Cell(30, 7, $total." EUR", 1, 0, 'L', true);
    }

    function ToUTF8($text) {
        return $this->UTF8ToUTF16BE($text);
    }
}

    $pdf = new PDF();
    $pdf->SetFont('Arial','',11);
    $pdf->AddPage();

    // Titres des colonnes
    $header = array(
        Array('width' => '30', 'content' => 'Date'),
        Array('width' => '80', 'content' => 'Motif'),
        Array('width' => '50', 'content' => 'Type'),
        Array('width' => '30', 'content' => 'Montant')
        );
    // Chargement des données
    $types = Array('default' => 'Autre frais', 'km' => 'Frais de transport');
    $data = Array();
    foreach ($fees as $key => $fee) {
        array_push($data, Array($fee->creation_date, $fee->caption, $types[$fee->id_fee_type], $fee->amount*$fee->coef." EUR"));
    }
    $pdf->SetFillColor(224,235,255);
    $pdf->SetDrawColor(33,150,243);
    $pdf->Write(7, utf8_decode("Je soussigné ".$member->f_name." ".$member->l_name.", demeurant au :"));
    $pdf->Ln();
    $pdf->Cell(190, 7, utf8_decode($member->adress." ".$member->postal_code." ".$member->city), 1, 0, 'C', true);
    $pdf->Ln();
    $pdf->Write(7, utf8_decode("certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association: "));
    $pdf->Ln();
    $pdf->Cell(190, 7, utf8_decode($member->club->name), 1, 0, 'C', true);
    $pdf->Ln();
    $pdf->Write(7, utf8_decode("en tant que don."));
    $pdf->Ln();
    $pdf->Ln();
    //Tableau
    $pdf->FancyTable($header,$data);
    $pdf->Total($note->total);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->SetTextColor(10,105,182);
    $pdf->SetFillColor(224,235,255);
    $pdf->SetDrawColor(33,150,243);
    $pdf->Write(7, utf8_decode("Mon numéro de licence est le suivant :"));
    $pdf->Ln();
    $pdf->Cell(190, 7, utf8_decode($member->licence_num), 1, 0, 'C', true);
    $pdf->Ln();
    $pdf->Write(7, utf8_decode("Montant des dons :"));
    $pdf->Ln();
    $pdf->Cell(190, 7, utf8_decode($note->total." EUR"), 1, 0, 'C', true);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->SetFillColor(255,255,255);
    $pdf->SetDrawColor(255,255,255);
    $pdf->SetFont('','I');
    $pdf->Cell(190, 7, utf8_decode("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de tous les justificatifs correspondants."), 0, 0, 'C', true);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->SetFont('','');
    $pdf->SetFillColor(224,235,255);
    $pdf->SetDrawColor(33,150,243);
    $pdf->Cell(95, 7, utf8_decode("A ___________________________"), 0, 0, 'LT', true);
    $pdf->Cell(95, 7, utf8_decode("Le __________________________"), 0, 0, 'LT', true);
    $pdf->Ln();
    $pdf->Cell(190, 30, utf8_decode("Signature du bénévole"), 0, 0, 'LT', true);
    $pdf->Ln();

    $pdf->SetFillColor(210,210,210);
    $pdf->SetDrawColor(180,180,180);
    $pdf->SetTextColor(90,90,90);
    $pdf->SetFont('','B');
    $pdf->Cell(190, 7, utf8_decode("Partie réservée à l'association."), 0, 0, 'LT', true);
    $pdf->Ln();
    $pdf->SetFont('','');
    $pdf->Cell(190, 10, utf8_decode("Remis le : ___________"), 0, 0, 'LT', true);
    $pdf->Ln();
    $pdf->Cell(190, 30, utf8_decode("Signature du trésorier"), 0, 0, 'LT', true);
    $pdf->Ln();
    $pdf->Ln();

    $id = date('dmYhms');
    $file = $pdf->Output("F", 'public/file/pdf_'.$id.'.pdf');
    $link = "http://$_SERVER[HTTP_HOST]".'/public/file/pdf_'.$id.'.pdf';

?>
