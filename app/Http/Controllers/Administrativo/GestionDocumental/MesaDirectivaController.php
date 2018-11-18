<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use App\Model\Administrativo\GestionDocumental\MesaDirectiva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesaDirectivaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrativo.gestiondocumental.mesa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.gestiondocumental.mesa.create');
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
     * @param  \App\MesaDirectiva  $mesaDirectiva
     * @return \Illuminate\Http\Response
     */
    public function show(MesaDirectiva $mesaDirectiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MesaDirectiva  $mesaDirectiva
     * @return \Illuminate\Http\Response
     */
    public function edit(MesaDirectiva $mesaDirectiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MesaDirectiva  $mesaDirectiva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MesaDirectiva $mesaDirectiva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MesaDirectiva  $mesaDirectiva
     * @return \Illuminate\Http\Response
     */
    public function destroy(MesaDirectiva $mesaDirectiva)
    {
        //
    }
}
