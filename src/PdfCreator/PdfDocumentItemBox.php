<?php

namespace PdfCreator;

use PdfCreator\FPDFExtensions\FPDFExtended;

class PdfDocumentItemBox extends PdfDocumentItem {
		
	public function render(FPDFExtended $pdf) {
		parent::render($pdf);
		
		$pdf->SetDrawColor($this->getForegroundColor()->getRed(),$this->getForegroundColor()->getGreen(),$this->getForegroundColor()->getBlue());
		$pdf->SetFillColor($this->getBackgroundColor()->getRed(),$this->getBackgroundColor()->getGreen(),$this->getBackgroundColor()->getBlue());
		$pdf->SetLineWidth($this->getSize());
		$pdf->Rect($this->getX1(), $this->getY1(), $this->getX2() - $this->getX1(), $this->getY2() - $this->getY1());
	}
	
}