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
}
