<?php

namespace PdfCreator;

use PdfCreator\FPDFExtensions\FPDFExtended;

class PdfDocumentItemBarCode extends PdfDocumentItem {
		
	public function render(FPDFExtended $pdf) {
		parent::render($pdf);
		
		$pdf->SetDrawColor($this->getForegroundColor()->getRed(),$this->getForegroundColor()->getGreen(),$this->getForegroundColor()->getBlue());
		$font = strtolower($this->getFontName());
		if($font == 'interleaved 2of5 nt') {
			$pdf->i25(
					$this->getX1(),
					$this->getY1(),
					$this->getText(),
					$this->getSize(),
					$this->getY2() - $this->getY1()
					);
		}
	}
	
}