<?php

namespace App\Http\Controllers;

use App\Models\Fkko;
use Illuminate\Http\Request;

class FkkoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fkko  $fkko
     * @return \Illuminate\Http\Response
     */
    public function show(Fkko $fkko)
    {
        $fkko = Fkko::find(1);
        dd($fkko);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fkko  $fkko
     * @return \Illuminate\Http\Response
     */
    public function edit(Fkko $fkko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fkko  $fkko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fkko $fkko)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fkko  $fkko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fkko $fkko)
    {
        //
    }
}
