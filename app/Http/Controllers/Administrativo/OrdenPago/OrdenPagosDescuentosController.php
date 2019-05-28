<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\Registro\Registro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;


class OrdenPagosDescuentosController extends Controller
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
        return view('administrativo.ordenpagos.createDescuentos', compact('ordenPago'));

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
        $registro = Registro::findOrFail($ordenPago->registros_id);
        $id = $request->id;
        $valor = $request->valor;
        $nombre = $request->nombre;
        $porcentaje = $request->porcent;
        $base = $request->base;

        $count = count($base);

        for($i = 0; $i < $count; $i++){
            if($id[$i]){
                $this->update($id[$i], $nombre[$i], $valor[$i], $ordenPago_id, $porcentaje[$i], $base[$i]);
            }elseif($registro->saldo < $base[$i]){
                Session::flash('warning','El valor de base no puede ser superior al valor disponible del registro: '.$registro->saldo);
                return  back();
            }else{
                $ordenPagoDes = new OrdenPagosDescuentos();
                $ordenPagoDes->nombre = $nombre[$i];
                $ordenPagoDes->porcent = $porcentaje[$i];
                $ordenPagoDes->base = $base[$i];
                $x = $base[$i] * $porcentaje[$i];
                $y = $x/100;
                $ordenPagoDes->valor = $y;
                $ordenPagoDes->orden_pagos_id = $ordenPago_id;
                $ordenPagoDes->save();
            }
        }
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orden_pagos_descuentos  $orden_pagos_descuentos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OrdenPagosDescuentos::where('orden_pagos_id', $id)->get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orden_pagos_descuentos  $orden_pagos_descuentos
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenPagosDescuentos $orden_pagos_descuentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orden_pagos_descuentos  $orden_pagos_descuentos
     * @return \Illuminate\Http\Response
     */
    public function update($id, $nombre, $valor, $orden_id, $porc, $base)
    {
        $ordenPago = OrdenPagos::findOrFail($orden_id);
        $Descuento = OrdenPagosDescuentos::findOrFail($id);
        $registro = Registro::findOrFail($ordenPago->registros_id);

        if ($registro->saldo < $base){
            Session::flash('warning','El valor de base no puede ser superior al valor disponible del registro: '.$registro->saldo);
        } else{
            $x = $base * $porc;
            $y = $x/100;
            $Descuento->valor = $y;
            $Descuento->porcent = $porc;
            $Descuento->base = $base;
            $Descuento->nombre = $nombre;
            $Descuento->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orden_pagos_descuentos  $orden_pagos_descuentos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descuento = OrdenPagosDescuentos::findOrFail($id);
        $descuento->delete();
        Session::flash('error','Descuento eliminado correctamente de la orden de pago');

    }
}
