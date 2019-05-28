<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Registro\Registro;
use Session;

class OrdenPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenPagoTarea = OrdenPagos::where('estado', '0')->get();
        $ordenPagos = OrdenPagos::where('estado','!=', '0')->get();

        return view('administrativo.ordenpagos.index', compact('ordenPagos','ordenPagoTarea'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Registros = Registro::where([['secretaria_e', '3'],['saldo','>', 0]])->get();
        $numOP = count(OrdenPagos::all());
        if ($Registros == null){
            Session::flash('warning','No hay registros disponibles para crear la orden de pago, debe crear un nuevo registro. ');
            return redirect('/administrativo/ordenPagos');
        }else{
            return view('administrativo.ordenpagos.create', compact('Registros','numOP'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registro_id = Registro::findOrFail($request->IdR);

        if ($registro_id->saldo <= 0){
            Session::flash('warning','El valor no puede ser superior al valor disponible del registro seleccionado: '.$registro_id->saldo);
            return redirect('/administrativo/ordenPagos/create');
        } else{
            $ordenPago = new OrdenPagos();
            $ordenPago->nombre = $request->concepto;
            $ordenPago->valor = 0;
            $ordenPago->saldo = 0;
            $ordenPago->estado = $request->estado;
            $ordenPago->registros_id = $request->IdR;
            $ordenPago->user_id = auth()->user()->id;
            $ordenPago->save();

            Session::flash('success','La orden de pago se ha creado exitosamente');
            return redirect('/administrativo/ordenPagos');
        }
    }

    public function liquidacion($id)
    {
        $ordenPago = OrdenPagos::findOrfail($id);
        $registro = Registro::findOrFail($ordenPago->registros_id);
        $Pagos = OrdenPagos::where('estado','=',1);
        $SumPagos = $Pagos->sum('valor');
        return view('administrativo.ordenpagos.createLiquidacion', compact('ordenPago','registro','SumPagos'));
    }

    public function liquidar(Request $request)
    {
        $ordenPago = OrdenPagos::findOrFail($request->ordenPago_id);
        $registro = Registro::findOrFail($ordenPago->registros_id);
        $registro->saldo = $registro->saldo - $request->valor;
        $registro->save();
        $ordenPago->estado = "1";
        $ordenPago->valor = $request->valor;
        $ordenPago->saldo = $request->valor;
        $ordenPago->save();
        Session::flash('success','La orden de pago se ha liquidado exitosamente');
        return redirect('/administrativo/ordenPagos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orden_pagos  $orden_pagos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $OrdenPago = OrdenPagos::findOrFail($id);
        $OrdenPagoDescuentos = OrdenPagosDescuentos::where('orden_pagos_id', $id)->get();

        return view('administrativo.ordenpagos.show', compact('OrdenPago','OrdenPagoDescuentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orden_pagos  $orden_pagos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Registros = Registro::where('secretaria_e', '3')->get();
        $ordenPago = OrdenPagos::findOrFail($id);
        return view('administrativo.ordenpagos.edit', compact('Registros','ordenPago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orden_pagos  $orden_pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ordenPago = OrdenPagos::findOrFail($id);
        $Descuentos = OrdenPagosDescuentos::where('orden_pagos_id','=',$ordenPago->id)->get();

        if($Descuentos->count() == 0){
            $ordenPago->nombre = $request->nombre;
            $ordenPago->save();

            Session::flash('success','La orden de pago se ha actualizado exitosamente');
            return redirect('/administrativo/ordenPagos');

        } else{

            Session::flash('warning','Ya se tienen asignados descuentos a la orden de pago, no puede ser modificada');
            return redirect('/administrativo/ordenPagos/'.$id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orden_pagos  $orden_pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descuentos = OrdenPagosDescuentos::where('orden_pagos_id','=',$id)->get();
        $orden = OrdenPagos::findOrFail($id);

        if (count($descuentos) > 0){
            Session::flash('warning', 'Tiene '.count($descuentos).' Descuentos Relacionados a la Orden de Pago. Elimine los Descuentos para Poder Eliminar la Orden de Pago');
            return redirect('/administrativo/ordenPagos/'.$id.'/edit');
        }else{
            $orden->delete();
            Session::flash('error','Orden de pago eliminada correctamente');
            return redirect('/administrativo/ordenPagos');
        }
    }
}
