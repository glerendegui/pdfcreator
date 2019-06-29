<?php

namespace PdfCreator;

class PdfColor {
	
	private $intValue;
	
	private function calculateRGBFromHex($hexString) {
		if($hexString[0] == "#") $hexString=substr($hexString,1);
		if(strlen($hexString) != 6) {
			$this->intValue = 0;
		} else {
			list($rHex, $gHex, $bHex) = sscanf($hexString, "%02x%02x%02x");
			$this->intValue = $rHex*256*256 + $gHex * 256 + $bHex;
		}
	}
	
	public function getRed() {
		return floor($this->intValue / (256*256)); 
	}
	public function getGreen() {
		return floor( ($this->intValue - 256*256*$this->getRed()) / (256)); 
	}
	public function getBlue() {
		return $this->intValue % 256;
	}
	public function getIntValue() {
		return $this->intValue;
	}
	
	public function __construct($value) {
		if((strlen($value) > 0)&&($value[0] == "#")) $this->calculateRGBFromHex($value);
		else $this->intValue = (int) $value;
	}
	
}