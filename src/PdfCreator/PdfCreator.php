<?php

namespace PdfCreator;

class PdfCreator {
	/** 
	 * @param string $csvTemplateFilename
	 * 
	 * @return PdfDocument
	 */
	public static function createPdfDocumentFromTemplate($csvTemplateFilename) {
		
		$fileHandler = fopen($csvTemplateFilename,"r");
		if(!$fileHandler) throw new \Exception("Could not open csv template (".$csvTemplateFilename.")");
		
		$document = new PdfDocument();
		
		$line = 0;
		while (($data = fgetcsv($fileHandler, 2000, ";", "'")) !== FALSE) {
			$line ++;
			/** @var PdfDocumentItem $item */
			if(empty($data)) continue;
			if((sizeof($data) == 1)&&(strlen(trim($data[0])) == 0)) continue;
			try {
				$item = PdfDocumentItem::createFromInfo($data);
			} catch(\Exception $ex) {
				throw new \Exception("Wrong data on line ".$line." - ".$ex->getMessage());
			}
			if(!$item) throw new \Exception("Wrong data (".implode(';',$data).")");
			$document->setElement($item->getId(),$item);
		}
		fclose($fileHandler);
		
		
		return $document;
		
	}
	
	
}