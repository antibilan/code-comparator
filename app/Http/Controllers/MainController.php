<?php

namespace App\Http\Controllers;

use App\Comparator;
use App\Services\Comparator\ComparatorService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $s = $request->input('search');
        dd($s);
    }

    public function analyze(Request $request)
    {
        $file1 = $request->file('fileCompany');
        $file2 = $request->file('fileFkko');

        ComparatorService::analyzeSimilarity($file1, $file2);
    }

    // public function compare(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //         $missingCodes = ComparatorService::compareDocumentsByColumn($document1, $document2, 'code');
    //         $missingNames = ComparatorService::compareDocumentsByColumn($document1, $document2, 'name');
    //     }

    //     dd($missingNames);
    //     //dd($missingCodes);

    // }
}
