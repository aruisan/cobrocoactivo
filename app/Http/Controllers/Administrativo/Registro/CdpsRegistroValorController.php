<?php

namespace App\Http\Controllers\Administrativo\Registro;

use App\Model\Administrativo\Registro\CdpsRegistroValor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CdpsRegistroValorController extends Controller
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
     * @param  \App\CdpsRegistroValor  $cdpsRegistroValor
     * @return \Illuminate\Http\Response
     */
    public function show(CdpsRegistroValor $cdpsRegistroValor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CdpsRegistroValor  $cdpsRegistroValor
     * @return \Illuminate\Http\Response
     */
    public function edit(CdpsRegistroValor $cdpsRegistroValor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CdpsRegistroValor  $cdpsRegistroValor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CdpsRegistroValor $cdpsRegistroValor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CdpsRegistroValor  $cdpsRegistroValor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cdpsRegistrosValor = CdpsRegistroValor::where('cdps_registro_id', $id)->get();
        foreach ($cdpsRegistrosValor as $borrar){
            $borrar->delete();
        }
        Session::flash('error','Dinero liberado correctamente del registro');
    }
}
