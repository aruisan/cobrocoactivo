<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental\Comisiones;

use App\Model\Administrativo\GestionDocumental\Comisiones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComisionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if ($id == 1){
            $comision = "Comisión del Plan";
        } elseif ($id == 2){
            $comision = "Comisión de Presupuesto";
        } elseif ($id == 3){
            $comision = "Comisión Administrativa";
        } elseif ($id == 4){
            $comision = "Comisiones Accidentales";
        }
        return view('administrativo.gestiondocumental.comisiones.index', compact('comision','id'));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
