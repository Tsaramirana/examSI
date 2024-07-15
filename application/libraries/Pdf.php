<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/fpdf/fpdf.php';

class Pdf extends FPDF {
    

    public function __construct() {
        parent::__construct();
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
    }

    function Header() {
        // Set the header content
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reservation Details', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Set the footer content
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    // fonction de generation de pdf back end

    function GeneratePDF($date_reservation , $numero , $service , $prix) {
        // example d'utilisation :
        // $this->pdf->GeneratePDF('2024-07-15','AB123CD', 'Full Service' , '100' );
        // Table header
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(40, 10, 'Date Reservation', 1);
        $this->Cell(30, 10, 'Matricule', 1);
        $this->Cell(40, 10, 'Service', 1);
        $this->Cell(30, 10, 'Prix', 1);
        $this->Ln();
    
        // Table body
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 10, $date_reservation, 1);
        $this->Cell(30, 10, $numero, 1);
        $this->Cell(40, 10, $service, 1);
        $this->Cell(30, 10, $prix, 1);
        $this->Ln();
    
        // Output the PDF
        $this->Output('I', 'ReservationDetails.pdf');
    }
    
}
?>
