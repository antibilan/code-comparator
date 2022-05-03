<?php

namespace App\Services\Parser;

use App\Services\Parser\Row;

class Table extends TagObject
{
	/* Класс содержит массив объектов Row */
	
	public function __construct(string $data) { 
				
		//$this->data[0] = "<table>\n";
		$this->data['openTag'] = "<table>";

		$pattern = array("#<table.+?>#s", "#</table>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		if(isset($data)) {
			$this->data['content'] = $this->initTableWithRows($dataWithoutTags); //основные данные, массив строк(каждый элемент = class Row)	
		} else {
			$this->data['content'] = NULL;
		}
		
		//$this->data[2] = "</table>\n";
		$this->data['closeTag'] = "<table>";
		
		return $this;
			
	}

	public function initTableWithRows(string $data): array {
		$result = [];
		$rows = Document::findTags('tr', $data);
		foreach ($rows as $key => $row) {
			$result[] = new Row($row);
			$result[$key]->position = $key; //позиция строки (индекс) в массиве строк ака Table->data['content]
		}
		return $result;
	}
	
	public function __toString() {
		return implode('', $this->data);
	}

	// Найти строку (class Row) в таблице (Table) содержащей подстроку $string
	public function findRow($string): Row {
			
		$rows = $this->data['content'];

		foreach($rows as $row) {
			 foreach($row->data['content'] as $key => $val) {
				$gluedRow = $val->__toString();
				if(strpos($gluedRow, $string) !== false) {
					return $row;
				}
			}				
		}	
	}		
}
