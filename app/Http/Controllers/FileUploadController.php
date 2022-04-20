<?php

namespace App\Http\Controllers;

use App\Comparator;
use App\Services\Comparator\ComparatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Parser\ParserService;
use Exception;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->isMethod('post')) {
            
            $file1 = $request->file('fileCompany');
            $file2 = $request->file('fileFkko');

            $uploadFolder = 'public/uploads';
            $filename1 = $file1->getClientOriginalName();
            $filename2 = $file2->getClientOriginalName();

            try {
                $parsedDocument1 = (new ParserService)->parseFile($file1); //($file1->get());
                $parsedDocument2 = (new ParserService)->parseFile($file2);//($file2->get());
            } catch (Exception $e) {
                throw $e;
                return view('home');
            }

            //$result = ComparatorService::compareDocumentsByColumn($parsedDocument1, $parsedDocument2, 'name');

            $results = [
                ComparatorService::compareDocumentsByColumn($parsedDocument1, $parsedDocument2, 'name'),
                ComparatorService::compareDocumentsByColumn($parsedDocument1, $parsedDocument2, 'code'),  
            ];

            $test = ComparatorService::compareSideBySideByColumn($parsedDocument1, $parsedDocument2, 'name');

            dd($test);

            Storage::putFileAs($uploadFolder, $file1, $filename1);
            Storage::putFileAs($uploadFolder, $file2, $filename2);

            //return view('home', ['results' => $results]);
        }
    }
}
