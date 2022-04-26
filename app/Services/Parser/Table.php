<?php

namespace App\Services\Parser;

class Table {
	/* Класс содержит массив объектов Row */
	
	public $data = array(); //массив таблицы из строк Row <table><tr>...</tr></td>
	
	public function __construct($data) { 
				
		$this->data[0] = "<table>\n";
		
		$pattern = array("#<table.+?>#s", "#</table>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->data[1] = Row::initRows($dataWithoutTags); //основные данные, массив строк(каждый элемент = class Row)
		
		$this->data[2] = "</table>\n";
		
		return $this->data;
			
	}
	
	public function __toString() {
		return implode('', $this->data);
	}

	// Найти строку (class Row) в таблице (Table) содержащей подстроку $string
	public function findRow($string) {
			
		$rows = $this->data[1];
		//dd($table);

		foreach($rows as $rowKey => $row) {
			 foreach($row->data[1] as $key => $val) {
				$gluedRow = $val->__toString();
				if(strpos($gluedRow, $string) !== false) {
					return $row;
					// также нужен индекс строки в массиве table[1], для этого надо переделать классы парсера
				}
			}				
		}	


		// for ($i = 1; $i < count($this->data)-1; $i++) {
			
		// 	if (strpos($this->data[$i]->__toString(), $string) != false ) {
		// 		$index = $i;
		// 		break;				 
		// 	}
		// }
		
		// return $this->data[1][$index];
	}		
}
