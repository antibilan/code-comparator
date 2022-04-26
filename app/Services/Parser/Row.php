<?php

namespace App\Services\Parser;

use APP\Services\Parser\TagObject;

class Row extends TagObject
{		
	public function __construct(string $data) {
				
		$this->data['openTag'] = "<tr>";
					
		$pattern = array("#<tr.+?>#s", "#</tr>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->data['content'] = $this->initRowWithTd($dataWithoutTags);
		
		$this->data['closeTag'] = "</tr>";				
	}
	
	public function __toString() {
		return implode($this->data);
	}

	public function initRowWithTd(string $string): array {
				
		$result = [];
		$tdTags = Document::findTags('td', $string);
		foreach ($tdTags as $key => $td) {
			$result[] = new Tdata($td);
			$result[$key]->position = $key;
		}
			
		return $result;	
	}

	public function setPosition(int $index) {
		$this->position = $index;
	}
}
