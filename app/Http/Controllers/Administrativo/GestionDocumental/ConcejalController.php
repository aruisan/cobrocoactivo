<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use App\Model\Administrativo\GestionDocumental\Concejal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConcejalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrativo.gestiondocumental.concejales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.gestiondocumental.concejales.create');
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
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function show(Concejal $concejal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function edit(Concejal $concejal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concejal $concejal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concejal $concejal)
    {
        //
    }
}
