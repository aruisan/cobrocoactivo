<?php

namespace App\Http\Controllers\Administrativo\Pago;

use App\Model\Administrativo\Contabilidad\RubrosPuc;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\Pago\Pagos;
use App\Model\Administrativo\Pago\PagoRubros;
use App\Model\Administrativo\Pago\PagoBanks;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Registro\CdpsRegistroValor;
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

        if ($ordenPagos == null){
            Session::flash('warning', 'No hay ordenes de pago disponibles para crear el pago. ');
            return redirect('/administrativo/pagos');
        } else {
            return view('administrativo.pagos.create', compact('ordenPagos'));
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
        if ($request->Monto > $request->SaldoOP){

            Session::flash('warning','El valor que va a pagar: $'.$request->Monto.' es mayor al valor disponible de la orden de pago: $'.$request->SaldoOP);
            return back();
        } else {

            $Pago = new Pagos();
            $Pago->orden_pago_id = $request->IdOP;
            $Pago->valor = $request->Monto;
            $Pago->estado = "0";
            $Pago->save();

            if (count($Pago->orden_pago->rubros) == 1){
                $pagoRubros = new PagoRubros();
                $pagoRubros->pago_id = $Pago->id;
                $pagoRubros->rubro_id = $Pago->orden_pago->rubros[0]->cdps_registro->rubro->id;
                $pagoRubros->valor = $Pago->valor;
                $pagoRubros->save();

                return redirect('/administrativo/pagos/banks/'.$Pago->id);
            } else {
                return redirect('/administrativo/pagos/asignacion/'.$Pago->id);
            }
        }
    }

    public function asignacion($id){
        $pago = Pagos::findOrFail($id);
        $rubros = $pago->orden_pago->rubros;
        if (count($pago->orden_pago->rubros) == 1){
            return redirect('/administrativo/pagos/banks/'.$pago->id);
        } else {
            foreach ($rubros as $rubro){
                $valC[] = $rubro->valor;
            }
            $vOP = $pago->valor;
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
            return view('administrativo.pagos.createRubros', compact('pago','distri'));
        }
    }

    public function asignacionStore(Request $request){
        $pago = Pagos::findOrFail($request->pago_id);
        $valR = array_sum($request->valor);
        if ($valR == $pago->valor){
            for($i=0;$i< count($request->valor); $i++){
                $pagoRubros = new PagoRubros();
                $pagoRubros->pago_id = $pago->id;
                $pagoRubros->rubro_id = $request->idR[$i];
                $pagoRubros->valor = $request->valor[$i];
                $pagoRubros->save();
            }
            return redirect('/administrativo/pagos/banks/'.$pago->id);
        } else {
            Session::flash('warning','El valor tomado de los rubros debe ser igual al valor a pagar: $'.$pago->valor);
            return back();
        }

    }

    public function asignacionDelete(Request $request){
        $pagosRubro = PagoRubros::where('pago_id',$request->id)->get();
        foreach ($pagosRubro as $data){
            $delete = PagoRubros::findOrFail($data->id);
            $delete->delete();
        }
        Session::flash('warning','Los valores se han reiniciado');
        return redirect('administrativo/pagos/asignacion/'.$request->id);
    }

    public function bank($id){
        $pago = Pagos::findOrFail($id);
        if (count($pago->rubros) > 0){
            $PUCS = RubrosPuc::where('naturaleza','1')->get();

            return view('administrativo.pagos.createBanks', compact('pago','PUCS'));
        } else {
            Session::flash('warning','El pago no ha recibido la asignación del monto, por favor realizarla');
            return redirect('administrativo/pagos/asignacion/'.$pago->id);
        }

    }

    public function bankStore(Request $request){

        $valReceived =array_sum($request->val);
        $pago = Pagos::findOrFail($request->pago_id);
        $valTotal = $pago->valor;
        $valR =number_format($valReceived,0);
        $valT = number_format($valTotal,0);

        if ($valReceived == $valTotal){
            if ($request->type_pay == "1"){
                $pago->type_pay = "CHEQUE";
                $pago->num = $request->num_cheque;
            }elseif ($request->type_pay == "2"){
                $pago->type_pay = "ACCOUNT";
                $pago->num = $request->num_cuenta;
            }
            $pago->estado = "1";
            $pago->ff_fin = today()->format("Y-m-d");
            $pago->save();

            for($i=0;$i< count($request->banco); $i++){
                $bank = new PagoBanks();
                $bank->pagos_id = $request->pago_id;
                $bank->rubros_puc_id = $request->banco[$i];
                $bank->valor = $request->val[$i];
                $bank->save();
            }

            $OP = OrdenPagos::findOrFail($request->ordenPago_id);
            $OP->saldo = $OP->saldo -  $valTotal;
            $OP->save();

            Session::flash('success','El pago se ha finalizado exitosamente');
            return redirect('/administrativo/pagos/'.$pago->id);
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
