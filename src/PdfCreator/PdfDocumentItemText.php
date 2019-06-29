<?php

namespace PdfCreator;

use PdfCreator\FPDFExtensions\FPDFExtended;

class PdfDocumentItemText extends PdfDocumentItem {
		
	public function render(FPDFExtended $pdf) {
		parent::render($pdf);
		
		$pdf->SetDrawColor($this->getForegroundColor()->getRed(),$this->getForegroundColor()->getGreen(),$this->getForegroundColor()->getBlue());
		$pdf->SetFillColor($this->getBackgroundColor()->getRed(),$this->getBackgroundColor()->getGreen(),$this->getBackgroundColor()->getBlue());
		
		$style="";
		if($this->getBold()) $style .= "B";
		if($this->getItalic()) $style .= "I";
		if($this->getUnderline()) $style .= "U";
		
		if(strtolower($this->getFontName()) == "arial black") $this->setFontName('Arial');
		$pdf->SetFont($this->getFontName(),$style,$this->getSize());
		$pdf->SetXY($this->getX1(), $this->getY1());
		
		$text = $this->getText();
		$text = iconv('UTF-8', 'windows-1252', $text);
		
		if($this->getMultiline()) {
			$pdf->MultiCell(
					$this->getX2() - $this->getX1(), 
					$this->getY2() - $this->getY1(),
					$text,
					0,
					$this->getAlign(),
					false
					);
		} else {
			$pdf->Cell(
					$this->getX2()-$this->getX1(),
					$this->getY2()-$this->getY1(),
					$text,
					0,
					0,
					$this->getAlign()
					);
		}
		
	}
	
}