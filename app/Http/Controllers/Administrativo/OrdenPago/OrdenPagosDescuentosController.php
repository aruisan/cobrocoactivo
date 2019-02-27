<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
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
        $id = $request->id;
        $nombre = $request->nombre;
        $valor = $request->valor;

        $count = count($valor);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $nombre[$i], $valor[$i], $ordenPago_id);
            }elseif($ordenPago->saldo < $valor[$i]){
                Session::flash('warning','El valor no puede ser superior al valor disponible de la orden de pago: '.$ordenPago->saldo);
                return  back();

            }else{
                $ordenPago->saldo = $ordenPago->saldo - $valor[$i];
                $ordenPago->save();
                $ordenPagoDes = new OrdenPagosDescuentos();
                $ordenPagoDes->nombre = $nombre[$i];
                $ordenPagoDes->valor = $valor[$i];
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
    public function update($id, $nombre, $valor, $orden_id)
    {
        $ordenPago = OrdenPagos::findOrFail($orden_id);
        $Descuento = OrdenPagosDescuentos::findOrFail($id);
        $ordenPago->saldo = $ordenPago->saldo + $Descuento->valor;
        if ($valor > $ordenPago->saldo){
            Session::flash('warning','El valor no puede ser superior al valor disponible de la orden de pago: '.$ordenPago->saldo);
        } else{
            $ordenPago->saldo = $ordenPago->saldo - $valor;
            $ordenPago->save();
            $Descuento->valor = $valor;
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
        $ordenPago = OrdenPagos::findOrFail($descuento->orden_pagos_id);
        $ordenPago->saldo =$ordenPago->saldo +  $descuento->valor;
        $ordenPago->save();
        Session::flash('error','Descuento eliminado correctamente de la orden de pago');
        $descuento->delete();
    }
}
