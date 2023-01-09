<?php

namespace App\Http\Controllers;

use App\Comparator;
use App\Services\Comparator\ComparatorService;
use Illuminate\Http\Request;
use App\Models\Fkko;

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

    public function displayFkko(Request $request)
    {
        // $fkkoArr = [
        //     [
        //         'code' => '1 11 010 00 00 0',
        //         'name' => 'Отходы от предпосевной подготовки семян',
        //     ],
        //     [
        //         'code' => '1 11 010 11 49 5',
        //         'name' => 'семена зерновых, зернобобовых, масличных, овощных, бахчевых, корнеплодных культур непротравленные с истекшим сроком годности',
        //     ],
        // ];

        // Fkko::create(
        //     [
        //     'block' => '1',
        //     'code' => '1 11 010 00 00 0',
        //     'name' => 'Отходы от предпосевной подготовки семян',
        //     ]
        // );

        dd(Fkko::all());

        //dd('created');
    }
}
