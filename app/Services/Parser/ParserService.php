<?php

namespace App\Services\Parser;

use Exception;

//use App\Services\Parser\Document;

class ParserService
{
    public function parseFile($file): array
    {
        try {
            $document = new Document($file);
        } catch (Exception $e) {
            echo '<script language="javascript">';
            echo "alert(\" Parsing has been failed \")";
            //echo $e->getMessage();  
            echo '</script>';
            throw $e;
        }

        $tablesStr = $document->filterTables();
        
        $tables = [];
        foreach ($tablesStr as $tableStr) {
            $tables[] = new Table($tableStr);	
        }
             
        //$codeColumn = Document::getColumnInTable($tables[0], 2);
        //$nameColumn = Document::getColumnInTable($tables[0], 1);

        return  $tables;        
    }
 
}