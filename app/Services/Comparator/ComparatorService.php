<?php

namespace App\Services\Comparator;

use App\Services\Parser\Document;
use App\Services\Parser\ParserService;
use Exception;

class ComparatorService
{
    public static function compareDocumentsByColumn(array $document1, array $document2, $column) {
        
        if($column === 'name') {
            //company file
            $columnArray = Document::getColumnInTable($document1[0], 1);
             
             //fkko file
           	foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTable($document2[$key], 1);
	        }
        } elseif($column === 'code') {
            //company file
            $columnArray = Document::getColumnInTable($document1[0], 2);
            
            //fkko file
            foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTable($document2[$key], 0);
	        }

        }

        return array_udiff(
            $columnArray,
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

    public static function compareSideBySideByColumn(array $document1, array $document2, $column): array
    {
        if($column === 'name') {
            
            //company file
            $columnArray = Document::getColumnInTableAsIs($document1[0], 1);

            //fkko file
            foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTableAsIs($document2[$key], 1);
	        }
        } elseif($column === 'code') {
            
            //company file
            $columnArray = Document::getColumnInTableAsIs($document1[0], 2);
            
            //fkko file
            foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTableAsIs($document2[$key], 0);
	        }

        }

        return array_diff_ukey(
            $columnArray,
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

    public static function compareDocumentsByRow(array $document1, array $document2) {
        
        $table = $document1[0];
        $rowArray = Document::getRowsInTable($table);
        
        foreach ($document2 as $key => $blockTable) {
            $rowArrayFkko[] = Document::getRowsInTable($document2[$key], true);
        }

        $tmp = $table->findRow('Наименование');

        //return $rowArray;
        return $tmp;
    }
}
