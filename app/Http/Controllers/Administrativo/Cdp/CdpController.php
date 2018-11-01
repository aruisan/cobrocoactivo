<?php

namespace App\Http\Controllers\Administrativo\Cdp;

use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Hacienda\Presupuesto\Rubro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $cdps = Cdp::all();
        return view('administrativo.cdp.index', compact('cdps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubros = Rubro::all();
        $dependencia = auth()->user()->dependencia_id;
        return view('administrativo.cdp.create', compact('dependencia','rubros'));
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
        $cdp->saldo = $request->saldo;
        $cdp->rubro_id = $request->rubro_id;
        $cdp->save();
        Session::flash('success','El CDP se ha creado exitosamente');
        return redirect('/administrativo/cdp');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cdp = Cdp::findOrFail($id);
        $rubros = Rubro::all();
        foreach ($rubros as $rubro){
            $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor');
            $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
        }
        return view('administrativo.cdp..show', compact('cdp','rubros','valores','rubrosCdp'));
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
        $rubros = Rubro::all();
        return view('administrativo.cdp.edit', compact('idcdp','rubros'));
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
        $store->estado = $request->estado;
        $store->observacion = $request->observacion;
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
