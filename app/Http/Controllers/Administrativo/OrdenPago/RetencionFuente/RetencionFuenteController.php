<?php

namespace App\Http\Controllers\Administrativo\OrdenPago\RetencionFuente;

use App\Model\Administrativo\OrdenPago\RetencionFuente\RetencionFuente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class RetencionFuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RetencionFuente::all();
        return view('administrativo.contabilidad.retencionfuente.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contabilidad.retencionfuente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reteF = new RetencionFuente();
        $reteF->concepto = $request->concept;
        $reteF->uvt = $request->uvt;
        $reteF->base = $request->base;
        $reteF->tarifa = $request->tarifa;
        $reteF->codigo = $request->codigo;
        $reteF->cuenta = $request->cuenta;
        $reteF->save();

        Session::flash('success','La retención en la fuente '.$request->concept.' se ha almacenado exitosamente');
        return redirect('/administrativo/contabilidad/retefuente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RetencionFuente  $retencionFuente
     * @return \Illuminate\Http\Response
     */
    public function show(RetencionFuente $retencionFuente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetencionFuente  $retencionFuente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retens = RetencionFuente::findOrFail($id);
        return view('administrativo.contabilidad.retencionfuente.edit', compact('retens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetencionFuente  $retencionFuente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reteF = RetencionFuente::findOrFail($id);
        $reteF->concepto = $request->concept;
        $reteF->uvt = $request->uvt;
        $reteF->base = $request->base;
        $reteF->tarifa = $request->tarifa;
        $reteF->codigo = $request->codigo;
        $reteF->cuenta = $request->cuenta;
        $reteF->save();

        Session::flash('success','La retención en la fuente '.$request->concept.' se ha actualizado exitosamente');
        return redirect('/administrativo/contabilidad/retefuente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetencionFuente  $retencionFuente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retenF = RetencionFuente::findOrFail($id);
        $retenF->delete();

        Session::flash('error','La retención en la fuente se ha eliminado exitosamente');
        return redirect('/administrativo/contabilidad/retefuente');
    }
}
