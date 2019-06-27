<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\Puc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        return view('administrativo.contabilidad.puc.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contabilidad.puc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puc = new Puc();
        $puc->vigencia = $request->vigencia;
        $puc->levels = $request->niveles;
        $puc->save();

        return  redirect('administrativo/contabilidad/puc/level/create/'.$puc->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function show(Puc $puc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function edit(Puc $puc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puc $puc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puc $puc)
    {
        //
    }
}
