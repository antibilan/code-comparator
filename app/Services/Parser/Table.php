<?php

namespace App\Services\Parser;

class Table {
	/* Класс содержит массив объектов Row */
	
	public $table = array(); //массив таблицы из строк Row <table><tr>...</tr></td>

	
	public function __construct($data) { 
				
		$this->table[0] = "<table>\n";
		
		$pattern = array("#<table.+?>#s", "#</table>#s");	
		
		$dataWithoutTags = preg_replace($pattern, '', $data);
		
		$this->table[1] = Row::initRows($dataWithoutTags);
		
		$this->table[2] = "</table>\n";
		
		return $this->table;
			
	}
	
	public function __toString() {
		return implode('', $this->table);
	}
	
	
	
	
	
	// Найти номер строки (class Row) в таблице (Table) содержащей подстроку $string
	public function findRow($string) {
		
		$result=0;	
		
		for ($i = 1; $i < count($this->table)-1; $i++) {	
			
			if (strpos($this->table[$i]->__toString(), $string) != false ) {
				$result = $i;
				break;				 
			}
		}
		
		return $result;
	}
		
}
	

?>