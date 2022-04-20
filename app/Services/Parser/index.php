<?php

#header('Content-type: text/html; charset=windows-1251');
#header('Content-type: text/html; charset=UTF-8');

use App\Services\Parser\Document;
use App\Services\Parser\Table;

require_once('classes/Document.php');
require_once('classes/Table.php');

define("dockroot", (__DIR__));
ini_set('pcre.backtrack_limit', '5000000');

	$test = file_get_contents('pregtest.txt');
	$sourceFile = 'example.htm';
	$sourceFile2 = 'example2.htm';
	$sourceFkko = 'fkko.htm';
	
	//--------------TEST DATA---------------	
	$data2 = array(array('123','456','789'),
				  array('qwe','rty','asd'),
				  array(' Наименование отхода ','rty','asd'),
				 );	
	#$table1 = new Table($data2, '', '', '', 1, 1);	
	#$result = $table1->findRow('Наименование отхода');
	//--------------TEST DATA---------------
	
	
	$document = new Document($sourceFile2);
	$documentFkko = new Document($sourceFkko);
	
	$fkkoTables = $documentFkko->filterTables();
	$tablesStr = $document->filterTables();
	
	#var_dump($fkkoTables);
	#var_dump($tablesStr);
	
	$fkkoTablesObj = array();
	foreach ($fkkoTables as $tableStr) {
		$fkkoTablesObj[] = new Table($tableStr);
	}
	
	#var_dump($fkkoTablesObj[0]);
	
	$tables = array();
	foreach ($tablesStr as $tableStr) {
		$tables[] = new Table($tableStr);	
	}
	
	#var_dump($tables[0]);
	
	$codeColumn = Document::getColumnInTable($tables[0], 2);
	$nameColumn = Document::getColumnInTable($tables[0], 1);
	$codeColumnFkko = array();
	$nameColumnFkko = array();
	#$codeColumnFkko = Doc::getColumnInTable($fkkoTablesObj[0], 0);
	#$nameColumnFkko = Doc::getColumnInTable($fkkoTablesObj[0], 1);
	
	foreach ($fkkoTablesObj as $key => $value) {
		$codeColumnFkko[] = Document::getColumnInTable($fkkoTablesObj[$key], 0);
		$nameColumnFkko[] = Document::getColumnInTable($fkkoTablesObj[$key], 1);
	}
	
	
	
	#var_dump(trim(mb_strtolower($nameColumnFkko[1])));
	#var_dump(mb_strtolower($nameColumnFkko[1]));
	
	#var_dump($codeColumnFkko);
	#var_dump($nameColumnFkko);
	
	#var_dump($tables[0]->table[1][0]->row[2][0]);
	#var_dump($fkkoTablesObj[0]->table[1][9]->row[1][1]);
	#echo count($fkkoTablesObj[0]->table[1][1]->row[1]);
	#var_dump($fkkoTablesObj[0]->table[1][10]->row[1][0]);
	#var_dump($fkkoTablesObj[0]->table[1][0]->row[1][1]->dataWithTags[1]);
	
	#$result = array_udiff($codeColumn, $codeColumnFkko, 'strcasecmp');
	

	
	
	/* $a = str_replace(array("\r\n", "\n", "\r"), '', $codeColumn[1]);
	$b = $codeColumnFkko[0][4];
	var_dump($a);
	var_dump($b);
	var_dump(strcasecmp($a, $b)); */
	
	
	function compareWithFkko($columnArray, $columnArrayFkko) {
		return array_udiff($columnArray,
							$columnArrayFkko[0],
							$columnArrayFkko[1],
							$columnArrayFkko[2],
							$columnArrayFkko[3],
							$columnArrayFkko[4],
							$columnArrayFkko[5],
							$columnArrayFkko[6],
							$columnArrayFkko[7],
							'strcmp');
	}
	
	
	$resultCode = compareWithFkko($codeColumn, $codeColumnFkko);
	$resultName = compareWithFkko($nameColumn, $nameColumnFkko);
	
	
	var_dump($resultCode);
	echo "\n";
	var_dump($resultName);



?>