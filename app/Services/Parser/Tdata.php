<?php

namespace App\Services\Parser;

class Tdata {
	//public $positionInRow;
	public $dataWithTags = array();
	
	public function __construct($data) {
		
		$this->dataWithTags[0] = "<td>";
					
		$pattern = array("#<td.+?>#s", "#</td>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->dataWithTags[1] = trim(strip_tags($dataWithoutTags)); // $this->dataWithTags[1] = Span:initSpan($dataWithoutTags);
		
		$this->dataWithTags[2] = "</td>";
		
	}
	
	public function __toString() {
		return implode($this->dataWithTags);
	}
	
	public function getCleanData() {
		return $this->dataWithoutTags;
	}	
}
