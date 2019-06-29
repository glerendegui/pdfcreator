<?php

namespace PdfCreator;

use PdfCreator\FPDFExtensions\FPDFExtended;

class PdfDocument {
	
	private $elements = array();
	private $pdf = null;
	
	public static function __pdf_document_cmp_item(PdfDocumentItem $item1, PdfDocumentItem $item2) {
		if(!$item1) return 1;
		if(!$item2) return -1;
		if($item1->getPriority() == $item2->getPriority()) return 0;
		if($item1->getPriority() < $item2->getPriority()) return 1;
		return -1;
	}
	private function sortElements() {
		uasort($this->elements,array("PdfCreator\PdfDocument","__pdf_document_cmp_item"));
	}
	
	public function __construct($format='A4',$orientation='portrait') {
		$this->pdf = new FPDFExtended($orientation,'mm',$format);
	}
	
	public function setElement($key,PdfDocumentItem $elementValue=null) {
		$this->elements[$key] = $elementValue;
	}
	
	public function changeElementText($key,$newText) {
		$element = $this->elements[$key];
		if($element) {
			$element->setText($newText);
		}
	}
	
	/**
	 * @param string $key
	 * @return PdfDocumentItem
	 */
	public function getElement($key) {
		if(isset($this->elements[$key])) return $this->elements[$key];
		else return null;
	}
	
	public function render() {
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial','B',16);
		$this->pdf->SetAutoPageBreak(false,0);
		$this->sortElements();
		
		foreach($this->elements as $element) {
			/** @var PdfDocumentItem $element */
			$element->render($this->pdf);
		}
	}
	
	public function saveToFile($path) {
		try {
			$this->pdf->Output('F',$path);
		} catch(\Exception $ex) {
			throw new \Exception("Could not write pdf output file (".$ex.")");
		}
	}
	
	
} 