<?php

namespace App\Services\Parser;

class Row {
	
	public array $data;
	public int $position;
	#public $data;
		
	public function __construct($data) {
				
		$this->data[0] = "<tr>\n";
					
		$pattern = array("#<tr.+?>#s", "#</tr>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->data[1] = Tdata::initTd($dataWithoutTags);
		
		$this->data[2] = "</tr>\n";				
	}
	
	public function __toString() {
		return implode('', $this->data);
	}

	public static function initRows($string) {
		$result = array();
		$rows = Document::find('tr', $string);
		foreach ($rows as $key => $row) {
			$result[] = new Row($row);			
		}
		return $result;
	}
}

?>