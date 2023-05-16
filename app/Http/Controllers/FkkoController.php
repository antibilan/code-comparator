<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fkko;
use App\Services\Parser\Document;
use Illuminate\Support\Facades\DB;

class FkkoController extends Controller
{
    public function create($paramBlock, $paramCode, $paramName){        

        Fkko::create([
            'block' => $paramBlock,
            'code' => $paramCode,
            'name' => $paramName,
        ]);

        dd('created');
    }

    public function fill($data) {
        foreach($data as $key => $table) {
            $result[$key] = Document::getRowsInTable($table, true);
            foreach($result[$key] as $rowData) {
                if ($key < 4) {
                    Fkko::create([                    
                        'block' => intval($key) + 1,
                        'code' => $rowData[0],
                        'name' => $rowData[1],
                    ]);
                } else {
                    Fkko::create([                    
                        'block' => intval($key) + 2, //there's no 5th block, after 4th the 6th goes
                        'code' => $rowData[0],
                        'name' => $rowData[1],
                    ]);
                }               
            }
        }
        dd('The data is filled.');
        return view('home', ['result' => $result]);
    }

    public function truncate() {
        $truncated = DB::table('fkko')->truncate();
        dd($truncated);
        return;
    }
}
