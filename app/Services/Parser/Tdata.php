<?php

namespace App\Services\Parser;

class Tdata {
	//public $positionInRow;
	public $dataWithTags = array();
	
	public function __construct($data) {
		
		$this->dataWithTags[0] = "<td>\n";
					
		$pattern = array("#<td.+?>#s", "#</td>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->dataWithTags[1] = strip_tags($dataWithoutTags); // $this->dataWithTags[1] = Span:initSpan($dataWithoutTags);
		
		$this->dataWithTags[2] = "</td>\n";
		
	}
	
	public function __toString() {
		return implode(NULL, $this->dataWithTags);
	}
	
	public function getCleanData() {
		return $this->dataWithoutTags;
	}	
	
	public static function initTd($string) {
				
		$result = array();
		$tdatas = Document::find('td', $string);
		foreach ($tdatas as $td) {
			$result[] = new Tdata($td);
		}
			
		return $result;	
	}
}
?>