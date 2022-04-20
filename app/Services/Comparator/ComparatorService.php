<?php

namespace App\Services\Comparator;

use App\Services\Parser\Document;
use App\Services\Parser\ParserService;
use Exception;

class ComparatorService
{
    public static function compareDocumentsByColumn(array $document1, array $document2, $column) {
        
        // $document1 = ParserService::parseFile($file1->get());
        // $document2 = ParserService::parseFile($file2->get());

        // $parsedDocument1 = $document1->parseFile($file1);
        // $parsedDocument2 = $document2->parseFile($file2);

        if($column === 'name') {
             $columnArray = Document::getColumnInTable($document1[0], 1);
           	foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTable($document2[$key], 1);
	        }
        } elseif($column === 'code') {
            $columnArray = Document::getColumnInTable($document1[0], 2);
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

    public static function analyzeSimilarity(array $document1, array $document2)
    {
        try {
            $parsedDocument1 = (new ParserService)->parseFile($document1);
            $parsedDocument2 = (new ParserService)->parseFile($document2);
            
        } catch (Exception $e) {
            throw $e;
            return view('home');
        }
    }

    public static function compareSideBySideByColumn(array $document1, array $document2, $column): array
    {
        //$result = [];

        if($column === 'name') {
            
            $columnArray = Document::getColumnInTableAsIs($document1[0], 1);

            foreach ($document2 as $key => $value) {
		        $columnArrayFkko[] = Document::getColumnInTableAsIs($document2[$key], 0);
	        }
        }

        //TODO: написать поиск массива 1 в массивах 2, в случае нахождения вывести 2 столбца (оригинальные строки первого массива, оригинальные строки второго массива)


        return $columnArray;
    }
}
