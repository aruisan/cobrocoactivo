<?php

namespace App\Http\Controllers\Hacienda\Presupuesto\Cdp;

use App\Model\Hacienda\Presupuesto\Cdp\Cdp;
use App\Model\Hacienda\Presupuesto\Rubro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Dependencia;
use Illuminate\Http\Response;

use Session;
class CdpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependencias = Dependencia::all();
        $rubros = Rubro::all();
        return view('hacienda.presupuesto.cdp.create', compact('dependencias','rubros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cdp = new Cdp();
        $cdp->name = $request->name;
        $cdp->valor = $request->valor;
        $cdp->fecha = $request->fecha;
        $cdp->dependencia_id = $request->dependencia_id;
        $cdp->estado = $request->estado;
        $cdp->observacion = $request->observacion;
        $cdp->ejecucion= $request->ejecucion;
        $cdp->saldo = $request->saldo;
        $cdp->rubro_id = $request->rubro_id;
        $cdp->save();
        Session::flash('success','El CDP se ha creado exitosamente');
        return redirect('../presupuesto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function show($cdp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function edit($cdp)
    {
        $idcdp = Cdp::find($cdp);
        $dependencias = Dependencia::all();
        $rubros = Rubro::all();
        return view('hacienda.presupuesto.cdp.edit', compact('idcdp', 'dependencias','rubros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idcdp)
    {
        $store= Cdp::findOrFail($idcdp);
        $store->name = $request->name;
        $store->valor = $request->valor;
        $store->fecha = $request->fecha;
        $store->dependencia_id = $request->dependencia_id;
        $store->estado = $request->estado;
        $store->observacion = $request->observacion;
        $store->ejecucion = $request->ejecucion;
        $store->saldo = $request->saldo;
        $store->rubro_id = $request->rubro_id;
        $store->save();

        Session::flash('success','El CDP '.$request->name.' se edito exitosamente.');
        return  redirect('../presupuesto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cdp $cdp)
    {
        //
    }
}