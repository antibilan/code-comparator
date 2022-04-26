<?php

namespace App\Services\Parser;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

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
		// 	$this->findTags('html', $this->data);
		// } catch (Exception $e) {
		// 	throw new Exception('Non-HTML file is provided');
		// }
	}
	
	public static function findTags(string $tag, string $data) {
		if ($tag === 'meta') {
			$pattern = "#<meta.+?>#"; //did I miss "s" at the end?
		} elseif ($tag === 'html') {
				$pattern = "#<html.+?>#";
		} else {
			$pattern = "#<$tag.+?</$tag>#s";
			//var_dump($data);
			//$pattern = "#$tag#";
		}

		////BUG in preg_match_all: some <td>bla</td> are parsed with additional spaces between words. Something wrong with new lines
		//Example: example.html, line: отходы изделий технического назначения из полипропилена незагрязненные
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
			$metaStrArr = $this->findTags('meta', $this->data);	
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
	public static function getColumnInTable(Table $table, int $columnNumber): array {
		
		$result = array();
		$tableData = $table->data[1];

		foreach ($tableData as $row) {
			//if (isset($row->data[1][$column])) {							
			
			if (count($row->data[1]) >= 2) { //don't take rows with 0 or 1 <td> aka columns, as we need only rows containing both Code and Name
				$rawTdContent = $row->data[1][$columnNumber]->dataWithTags[1];
				$result[] = self::formatRawString($rawTdContent);
			}
		}
		return $result;			
	}

	public static function getColumnInTableAsIs(Table $table, int $columnNumber): array {
		
		$result = array();
		$tableData = $table->data[1];

		foreach ($tableData as $row) {
			//if (isset($row->data[1][$column])) {
			if (count($row->data[1]) >= 2) { //don't take rows with 0 or 1 <td> aka columns, as we need only rows containing both Code and Name
				
				$rawTdContent = $row->data[1][$columnNumber]->dataWithTags[1];
				
				$key = trim( str_replace( array("\r\n", "\n", "\r"), '' , $rawTdContent));
				$value = self::formatRawString($rawTdContent);

				$result[$key] = $value;
			}
		}
		return $result;
	}

	public static function getRowsInTable(Table $table, $fkkoFlag = false): array {
		$result = array();
		$tableData = $table->data['content'];

		foreach($tableData as $row) {
			if (count($row->data['content']) >= 2) {
				if (!$fkkoFlag) {
					$result[] = [
						$row->data['content'][2]->dataWithTags[1],
						$row->data['content'][1]->dataWithTags[1],
					];
				} else {
					$result[] = [
						$row->data['content'][0]->dataWithTags[1],
						$row->data['content'][1]->dataWithTags[1],
					];
				}
			}
		}

		return $result;
	}
	
	public function filterTables(): array {	
		
		$result = array();
		
		try {
			$tables = $this->findTags('table', $this->data);
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

	private static function formatRawString(string $string): string {
		$output = trim(
			mb_strtolower( 	// to lowercase
			str_replace(	// remove nbsp, double- and triple- spaces
			array('&nbsp;', '  ', '   '), ' ', (
			str_replace(	// remove new lines
			array("\r\n", "\n", "\r"), '' , $string))))
		);

		return $output;	
	}				
}
