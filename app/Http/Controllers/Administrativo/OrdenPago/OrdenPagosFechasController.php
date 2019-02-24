<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\OrdenPagosFechas;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;


class OrdenPagosFechasController extends Controller
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
    public function create($id)
    {
        $ordenPago = OrdenPagos::findOrFail($id);
        return view('administrativo.ordenpagos.createFechas', compact('ordenPago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordenPago_id = $request->ordenPago_id;
        $ordenPago = OrdenPagos::findOrFail($ordenPago_id);
        $id = $request->id;
        $fecha = $request->fecha;
        $valor = $request->valor;

        $count = count($valor);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $fecha[$i], $valor[$i], $ordenPago_id);
            }elseif($ordenPago->saldo < $valor[$i]){
                Session::flash('warning','El valor no puede ser superior al valor disponible de la orden de pago: '.$ordenPago->saldo);
                return  back();
            }else{
                $ordenPago->saldo = $ordenPago->saldo - $valor[$i];
                $ordenPago->save();
                $ordenPagoFecha = new OrdenPagosFechas();
                $ordenPagoFecha->fecha = $fecha[$i];
                $ordenPagoFecha->valor = $valor[$i];
                $ordenPagoFecha->orden_pagos_id = $ordenPago_id;
                $ordenPagoFecha->save();
            }
        }
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orden_pagos_fechas  $orden_pagos_fechas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OrdenPagosFechas::where('orden_pagos_id', $id)->get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orden_pagos_fechas  $orden_pagos_fechas
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenPagosFechas $orden_pagos_fechas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orden_pagos_fechas  $orden_pagos_fechas
     * @return \Illuminate\Http\Response
     */
    public function update($id, $fecha, $valor, $orden_id)
    {
        $ordenPago = OrdenPagos::findOrFail($orden_id);
        $Fecha = OrdenPagosFechas::findOrFail($id);
        $ordenPago->saldo = $ordenPago->saldo + $Fecha->valor;
        if ($valor > $ordenPago->saldo){
            Session::flash('warning','El valor no puede ser superior al valor disponible de la orden de pago: '.$ordenPago->saldo);
        } else{
            $ordenPago->saldo = $ordenPago->saldo - $valor;
            $ordenPago->save();
            $Fecha->valor = $valor;
            $Fecha->fecha = $fecha;
            $Fecha->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orden_pagos_fechas  $orden_pagos_fechas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Fechas = OrdenPagosFechas::findOrFail($id);
        $ordenPago = OrdenPagos::findOrFail($Fechas->orden_pagos_id);
        $ordenPago->saldo =$ordenPago->saldo +  $Fechas->valor;
        $ordenPago->save();
        Session::flash('error','Fecha eliminada correctamente de la orden de pago');
        $Fechas->delete();
    }
}
