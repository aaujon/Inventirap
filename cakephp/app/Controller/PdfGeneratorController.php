<?php

class PdfGeneratorController extends AppController {

	private function createSampleDocument() {
		App::import('Vendor', 'fpdf/fpdf');

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(20,10,'Hello World!');

		return $pdf;
	}

	public function createDocument() {

		$fileName = 'document.pdf';
		$path = str_replace('webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']);
		$path .= 'tmp/pdf/' . $fileName;

		$pdf = $this->createSampleDocument();

		$pdf->Output($path, 'F');
		$this->Session->setFlash('Document correctement crée à cet emplacement : ' . $path);
	}


	public function downloadDocument() {
		$this->layout = 'xml';
		
		$pdf = $this->createSampleDocument();
		$pdf->Output('document.pdf', 'D');
	}
}

?>