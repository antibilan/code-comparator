<?php

namespace App\Services\Parser;

use Exception;
use Illuminate\Http\UploadedFile;

class Document {
	public string $data;
	public $charset;
	
	public function __construct(UploadedFile $html) {
		$this->data = $html->getContent($html);
		
		$charset = $this->detectCharset();

		if ($charset != 'UTF-8') {
			$this->setCharset('UTF-8');
			}	

		// try {
		// 	$this->find('html', $this->data);
		// } catch (Exception $e) {
		// 	throw new Exception('Non-HTML file is provided');
		// }
	}
	
	public static function find($tag, $data) {
		if ($tag === 'meta') {
			$pattern = "#<meta.+?>#"; //did I miss "s" at the end?
		} elseif ($tag === 'html') {
				$pattern = "#<html.+?>#";
		} else {
			$pattern = "#<$tag.+?</$tag>#s";
			//var_dump($data);
			//$pattern = "#$tag#";
		}
		preg_match_all($pattern, $data, $matches);

		if(empty($matches[0])) {
			throw new \Exception("Tag $tag was not found in the data");
		}
		return $matches[0];
	}
	
	public function setCharset($targetCharset) {
				$this->data = mb_convert_encoding($this->data, $targetCharset, $this->charset);
				$this->charset = $targetCharset;
	}	

	
	public function detectCharset() {
		
		try {
			$metaStrArr = $this->find('meta', $this->data);	
		} catch (Exception $e) {
			return $this->charset;
		}
		
		
		foreach ($metaStrArr as $metaStr) {
			
			$this->charset = 'UTF-8';
			
			if (stripos($metaStr, 'charset=windows-1251') !== false ) {
				$this->charset = 'Windows-1251';
				break;
			} elseif (stripos($metaStr, 'charset=utf-8') !== false ) {
				$this->charset = 'UTF-8';
				break;
			}
			
		}
		
		return $this->charset;
		
	}
	
	// Gets Table object $table and № of the column $column
	// Returns array of Tdata objects
	public static function getColumnInTable(Table $table, $column) {
		
		$result = array();
		$tableData = $table->table[1];

		foreach ($tableData as $row) {
			//if (isset($row->row[1][$column])) {
			if (count($row->row[1]) >= 2) { //don't take rows with 0 or 1 <td> aka columns, as we need only rows containing both Code and Name
				$result[] = trim(
							mb_strtolower( 	// to lowercase
							str_replace(	// remove nbsp, double- and triple- spaces
							array('&nbsp;', '  ', '   '), ' ', (
							str_replace(	// remove new lines
							array("\r\n", "\n", "\r"), '' , $row->row[1][$column]->dataWithTags[1])))));
			}
		}
		return $result;
		
	}

	public static function getColumnInTableAsIs(Table $table, $column): array {
		
		$result = array();
		$tableData = $table->table[1];

		foreach ($tableData as $row) {
			//if (isset($row->row[1][$column])) {
			if (count($row->row[1]) >= 2) { //don't take rows with 0 or 1 <td> aka columns, as we need only rows containing both Code and Name
				$key = trim( str_replace( array("\r\n", "\n", "\r"), '' , $row->row[1][$column]->dataWithTags[1]));
				$value = trim(
					mb_strtolower( 	// to lowercase
					str_replace(	// remove nbsp, double- and triple- spaces
					array('&nbsp;', '  ', '   '), ' ', (
					str_replace(	// remove new lines
					array("\r\n", "\n", "\r"), '' , $row->row[1][$column]->dataWithTags[1])))));
				$result[$key] = $value;
			}
		}
		return $result;
		
	}
	
	public function filterTables() {	
		
		$result = array();
		
		try {
			$tables = $this->find('table', $this->data);
		} catch(Exception $e) { 
			throw new Exception('Tag <table> was not found in the data');
		}
		
		
		foreach ($tables as $key) {
			if (stripos($key, 'Код') != false && stripos($key, 'Наименование') != false) {
				$result[] = $key;
			}		
		}
		
		return $result;
	
	}
	
}



?>