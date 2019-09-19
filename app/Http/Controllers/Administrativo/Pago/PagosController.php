<?php

namespace App\Http\Controllers\Administrativo\Pago;

use App\Model\Administrativo\Contabilidad\RubrosPuc;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\Pago\PagoBanks;
use App\Model\Administrativo\Pago\Pagos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagosTarea = Pagos::where('estado', '0')->get();
        $pagos = Pagos::where('estado','!=', '0')->get();

        return view('administrativo.pagos.index', compact('pagos','pagosTarea'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenPagos = OrdenPagos::where([['estado', '1'], ['saldo', '>', 0]])->get();
        $PUCS = RubrosPuc::where('naturaleza','1')->get();

        if ($ordenPagos == null){
            Session::flash('warning', 'No hay ordenes de pago disponibles para crear el pago. ');
            return redirect('/administrativo/pagos');
        } else {
            return view('administrativo.pagos.create', compact('ordenPagos','PUCS'));
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
        $valReceived =array_sum($request->val);
        $valTotal = $request->ValTo2;
        $valR =number_format($valReceived,0);
        $valT = number_format($valTotal,0);

        if ($valReceived == $valTotal){

            $Pago = new Pagos();
            $Pago->orden_pago_id = $request->IdOP;
            if ($request->type_pay == "1"){
                $Pago->num = $request->num_cheque;
                $Pago->type_pay = "CHEQUE";
            }elseif ($request->type_pay == "2"){
                $Pago->num = $request->num_cuenta;
                $Pago->type_pay = "ACCOUNT";
            }
            $Pago->valor = $valTotal;
            $Pago->estado = "1";
            $Pago->ff_fin = $request->ff;
            $Pago->save();

            $ordenPago = OrdenPagos::findOrFail($request->IdOP);
            $ordenPago->saldo = $ordenPago->saldo - $valReceived;
            $ordenPago->save();

            for($i=0;$i< count($request->banco); $i++){

                $banks = new PagoBanks();
                $banks->pagos_id = $Pago->id;
                $banks->rubros_puc_id = $request->banco[$i];
                $banks->valor = $request->val[$i];
                $banks->save();

            }

            Session::flash('success','El pago se ha finalizado exitosamente');
            return redirect('/administrativo/pagos/'.$Pago->id);
        } elseif ($valReceived > $valTotal){
            Session::flash('warning','El valor que va a pagar: $'.$valR.' es mayor al valor correspondiente del pago: $'.$valT);
            return back();
        } else{
            Session::flash('warning','El valor que va a pagar: $'.$valR.' es menor al valor correspondiente del pago: $'.$valT);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pagos::findOrFail($id);
        $ordenPago = OrdenPagos::findOrFail($pago->orden_pago_id);

        return view('administrativo.pagos.show', compact('pago','ordenPago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagos $pagos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagos $pagos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagos $pagos)
    {
        //
    }
}
