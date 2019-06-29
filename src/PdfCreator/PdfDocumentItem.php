<?php

namespace PdfCreator;

class PdfDocumentItem {
	const TYPE_TEXT = 'T';
	const TYPE_LINE = 'L';
	const TYPE_IMAGE = 'I';
	const TYPE_BOX = 'B';
	const TYPE_BARCODE = 'BC';
	const ALIGN_LEFT = 'L';
	const ALIGN_RIGHT = 'R';
	const ALIGN_CENTER = 'C';
	
	private $id = "";
	private $type;
	private $x1;
	private $y1;
	private $x2;
	private $y2;
	private $fontName;
	private $size;
	private $bold;
	private $italic;
	private $underline;
	private $foregroundColor;
	private $backgroundColor;
	private $align;
	private $text;
	private $priority;
	private $multiline = false;

	public static function createFromInfo($info) {
		if(sizeof($info) <= 1) throw new \Exception("Could not create item from empty info");
		switch ($info[1]) { // type
			case self::TYPE_LINE: return new PdfDocumentItemLine($info);
			case self::TYPE_TEXT: return new PdfDocumentItemText($info);
			case self::TYPE_IMAGE: return new PdfDocumentItemImage($info);
			case self::TYPE_BOX: return new PdfDocumentItemBox($info);
			case self::TYPE_BARCODE: return new PdfDocumentItemBarCode($info);
			default: throw new \Exception("Could not create item from unkonwn type (".$info[1].")");
		}
	}
	
	public function __construct($info=array()) {
		if(!empty($info)) {
			if(sizeof($info) >= 1) $this->setId($info[0]);
			if(sizeof($info) >= 2) $this->setType($info[1]);
			if(sizeof($info) >= 3) $this->setX1($info[2]);
			if(sizeof($info) >= 4) $this->setY1($info[3]);
			if(sizeof($info) >= 5) $this->setX2($info[4]);
			if(sizeof($info) >= 6) $this->setY2($info[5]);
			if(sizeof($info) >= 7) $this->setFontName($info[6]);
			if(sizeof($info) >= 8) $this->setSize($info[7]);
			if(sizeof($info) >= 9) $this->setBold($info[8]);
			if(sizeof($info) >= 10) $this->setItalic($info[9]);
			if(sizeof($info) >= 11) $this->setUnderline($info[10]);
			if(sizeof($info) >= 12) $this->setForegroundColor(new PdfColor($info[11]));
			if(sizeof($info) >= 13) $this->setBackgroundColor(new PdfColor($info[12]));
			if(sizeof($info) >= 14) $this->setAlign($info[13]);
			if(sizeof($info) >= 15) $this->setText($info[14]);
			if(sizeof($info) >= 16) $this->setPriority($info[15]);
			if(sizeof($info) >= 17) $this->setMultiline($info[16]);
		}
	}
	
	public function render(\FPDF $pdf) {
		
	}
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		switch ($type) {
			case self::TYPE_BARCODE: 
			case self::TYPE_BOX: 
			case self::TYPE_IMAGE: 
			case self::TYPE_LINE: 
			case self::TYPE_TEXT: break; 
			default: throw new \Exception('Invalid item type ('.$type.')');
		}
		$this->type = $type;
		return $this;
	}
	public function getX1() {
		return $this->x1;
	}
	public function setX1($x1) {
		$this->x1 = $x1;
		return $this;
	}
	public function getY1() {
		return $this->y1;
	}
	public function setY1($y1) {
		$this->y1 = $y1;
		return $this;
	}
	public function getX2() {
		return $this->x2;
	}
	public function setX2($x2) {
		$this->x2 = $x2;
		return $this;
	}
	public function getY2() {
		return $this->y2;
	}
	public function setY2($y2) {
		$this->y2 = $y2;
		return $this;
	}
	public function getFontName() {
		return $this->fontName;
	}
	public function setFontName($fontName) {
		$this->fontName = $fontName;
		return $this;
	}
	public function getSize() {
		return $this->size;
	}
	public function setSize($size) {
		$this->size = $size;
		return $this;
	}
	public function getBold() {
		return $this->bold;
	}
	public function setBold($bold) {
		$this->bold = $bold;
		return $this;
	}
	public function getItalic() {
		return $this->italic;
	}
	public function setItalic($italic) {
		$this->italic = $italic;
		return $this;
	}
	public function getUnderline() {
		return $this->underline;
	}
	public function setUnderline($underline) {
		$this->underline = $underline;
		return $this;
	}
	/**
	 * @return PdfColor
	 */
	public function getForegroundColor() {
		return $this->foregroundColor;
	}
	public function setForegroundColor($foregroundColor) {
		$this->foregroundColor = $foregroundColor;
		return $this;
	}
	/**
	 * @return PdfColor
	 */
	public function getBackgroundColor() {
		return $this->backgroundColor;
	}
	public function setBackgroundColor($backgroundColor) {
		$this->backgroundColor = $backgroundColor;
		return $this;
	}
	public function getAlign() {
		return $this->align;
	}
	public function setAlign($align) {
		/* Spanish fix */
		if($align == 'I') $align = self::ALIGN_LEFT;
		if($align == 'D') $align = self::ALIGN_RIGHT;
		
		switch ($align) {
			case self::ALIGN_CENTER:
			case self::ALIGN_LEFT:
			case self::ALIGN_RIGHT: break;
			default: throw new \Exception('Invalid item align ('.$align.')');
		}
		$this->align = $align;
		return $this;
	}
	public function getText() {
		return $this->text;
	}
	public function setText($text) {
		$this->text = $text;
		return $this;
	}
	public function getPriority() {
		return $this->priority;
	}
	public function setPriority($priority) {
		$this->priority = $priority;
		return $this;
	}
	public function getMultiline() {
		return $this->multiline;
	}
	public function setMultiline($multiline) {
		$this->multiline = $multiline;
		return $this;
	}
	
	
	
	
	
}