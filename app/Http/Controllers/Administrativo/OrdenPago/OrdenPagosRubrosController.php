<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\OrdenPago\OrdenPagosRubros;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\Registro\CdpsRegistroValor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class OrdenPagosRubrosController extends Controller
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
        $cdps = CdpsRegistroValor::where('registro_id',$ordenPago->registros_id)->get();
        if (count($cdps) == 1){
            $save = new OrdenPagosRubros();
            $save->cdps_registro_valor_id = $cdps[0]->id;
            $save->orden_pagos_id = $ordenPago->id;
            $save->valor = $ordenPago->valor;
            $save->saldo = $ordenPago->saldo;
            $save->save();

            return redirect('/administrativo/ordenPagos/descuento/create/'.$ordenPago->id);
        } else {
            foreach ($cdps as $cdp){
                $valC[] = $cdp->valor;
            }
            $vOP = $ordenPago->valor - $ordenPago->iva;
            foreach ($valC as $value){
                if ($vOP == 0){
                    $distri[] = 0;
                }else {
                    if ($vOP >= $value){
                        $vOP = $vOP - $value;
                        $distri[] = $value;
                        $a[] = $vOP;
                    } else {
                        $distri[] = $vOP;
                        $vOP = 0;
                    }
                }
            }
            return view('administrativo.ordenPagos.createRubros', compact('cdps','ordenPago','distri'));
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
        $ordenPago = OrdenPagos::findOrFail($request->ordenPago_id);
        $total = array_sum($request->Valor) + $request->ValorIva;
        if ( $total != $ordenPago->valor){
            Session::flash('warning','El valor distribuido no es igual al valor a pagar de la orden de pago: $'.$ordenPago->valor);
            return back();
        } else {
            for($i=0;$i< count($request->cdp_id); $i++){
                $store = new OrdenPagosRubros();
                $store->cdps_registro_valor_id = $request->cdp_id[$i];
                $store->orden_pagos_id = $request->ordenPago_id;
                $store->valor = $request->Valor[$i];
                $store->saldo = $request->Valor[$i];
                $store->save();
            }
            return redirect('/administrativo/ordenPagos/descuento/create/'.$request->ordenPago_id);
        }
    }

    public function massiveDelete(Request $request){
        $ordenPagosRubro = OrdenPagosRubros::where('orden_pagos_id',$request->id)->get();
        foreach ($ordenPagosRubro as $data){
            $delete = OrdenPagosRubros::findOrFail($data->id);
            $delete->delete();
        }
        Session::flash('warning','Los valores se han reiniciado');
        return redirect('administrativo/ordenPagos/monto/create/'.$request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdenPagosRubros  $ordenPagosRubros
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenPagosRubros $ordenPagosRubros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdenPagosRubros  $ordenPagosRubros
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenPagosRubros $ordenPagosRubros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdenPagosRubros  $ordenPagosRubros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenPagosRubros $ordenPagosRubros)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdenPagosRubros  $ordenPagosRubros
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenPagosRubros $ordenPagosRubros)
    {
        //
    }
}
