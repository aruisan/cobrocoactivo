<?php

namespace App\Http\Controllers\Administrativo\OrdenPago\DescMunicipales;

use App\Model\Administrativo\OrdenPago\DescMunicipales\DescMunicipales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class DescMunicipalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DescMunicipales::all();
        return view('administrativo.contabilidad.impuestosmuni.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contabilidad.impuestosmuni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $descM = new DescMunicipales();
        $descM->concepto = $request->concept;
        $descM->base = $request->base;
        $descM->tarifa = $request->tarifa;
        $descM->codigo = $request->codigo;
        $descM->cuenta = $request->cuenta;
        $descM->save();

        Session::flash('success','El impuesto municipal '.$request->concept.' se ha almacenado exitosamente');
        return redirect('/administrativo/contabilidad/impumuni');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DescMunicipales  $descMunicipales
     * @return \Illuminate\Http\Response
     */
    public function show(DescMunicipales $descMunicipales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DescMunicipales  $descMunicipales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desc = DescMunicipales::findOrFail($id);
        return view('administrativo.contabilidad.impuestosmuni.edit', compact('desc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DescMunicipales  $descMunicipales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $descM = DescMunicipales::findOrFail($id);
        $descM->concepto = $request->concept;
        $descM->base = $request->base;
        $descM->tarifa = $request->tarifa;
        $descM->codigo = $request->codigo;
        $descM->cuenta = $request->cuenta;
        $descM->save();

        Session::flash('success','El impuesto municipal '.$request->concept.' se ha actualizado exitosamente');
        return redirect('/administrativo/contabilidad/impumuni');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DescMunicipales  $descMunicipales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descM = DescMunicipales::findOrFail($id);
        $descM->delete();

        Session::flash('error','El impuesto municipal se ha eliminado exitosamente');
        return redirect('/administrativo/contabilidad/impumuni');
    }
}
