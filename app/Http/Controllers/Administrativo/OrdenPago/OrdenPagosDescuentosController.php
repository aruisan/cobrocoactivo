<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\RetencionFuente\RetencionFuente;
use App\Model\Administrativo\OrdenPago\DescMunicipales\DescMunicipales;
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
        $retenF = RetencionFuente::all();
        $desMun = DescMunicipales::all();
        $ordenPago = OrdenPagos::findOrFail($id);
        return view('administrativo.ordenpagos.createDescuentos', compact('ordenPago','retenF','desMun'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $retenFuente = RetencionFuente::findOrFail($request->retencion_fuente);
        $ordenPago_id = $request->ordenPago_id;
        $valor = $request->valor;
        $nombre = $retenFuente->concepto;
        $porcentaje = $retenFuente->tarifa;
        $base = $retenFuente->base;

        $ordenPagoDes = new OrdenPagosDescuentos();
        $ordenPagoDes->nombre = $nombre;
        $ordenPagoDes->porcent = $porcentaje;
        $ordenPagoDes->base = $base;
        $ordenPagoDes->valor = $valor;
        $ordenPagoDes->orden_pagos_id = $ordenPago_id;
        $ordenPagoDes->retencion_fuentes_id = $request->retencion_fuente;
        $ordenPagoDes->save();

        for($i=0;$i< count($request->idDes); $i++){
            $descMunicipales = DescMunicipales::findOrFail($request->idDes[$i]);
            $descuento = new OrdenPagosDescuentos();
            $descuento->nombre = $descMunicipales->concepto;
            $descuento->base = 0;
            $descuento->porcent = $descMunicipales->tarifa;
            $descuento->valor = $request->valorMuni[$i];
            $descuento->orden_pagos_id = $ordenPago_id;
            $descuento->desc_municipales_id = $request->idDes[$i];
            $descuento->save();
        }

        Session::flash('success','Los Descuentos se han Almacenado Exitosamente');
        return redirect('/administrativo/ordenPagos');
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
