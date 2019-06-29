<?php

namespace PdfCreator;

use PdfCreator\FPDFExtensions\FPDFExtended;

class PdfDocumentItemLine extends PdfDocumentItem {
		
	public function render(FPDFExtended $pdf) {
		parent::render($pdf);
		
		$pdf->SetDrawColor($this->getForegroundColor()->getRed(),$this->getForegroundColor()->getGreen(),$this->getForegroundColor()->getBlue());
		$pdf->SetLineWidth($this->getSize());
		$pdf->Line($this->getX1(), $this->getY1(), $this->getX2(), $this->getY2());
	}
	
}