<?php

namespace App\Services\Parser;

class Row {
	
	public $row = array();
	#public $data;
		
	public function __construct($data) {
				
		$this->row[0] = "<tr>\n";
					
		$pattern = array("#<tr.+?>#s", "#</tr>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->row[1] = Tdata::initTd($dataWithoutTags);
		
		$this->row[2] = "</tr>\n";		
		
	}
	
	public function __toString() {
		return implode('', $this->row);
	}

	public static function initRows($string) {
		$result = array();
		$rows = Document::find('tr', $string);
		foreach ($rows as $row) {
			$result[] = new Row($row);
		}
		return $result;
	}
}

?>