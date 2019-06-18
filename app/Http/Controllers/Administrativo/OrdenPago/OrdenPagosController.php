<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Http\Controllers\Administrativo\Cdp\CdpController;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos;
use App\Model\Administrativo\OrdenPago\OrdenPagosPuc;
use App\Model\Administrativo\OrdenPago\OrdenPagosPayments;
use App\Model\Administrativo\OrdenPago\OrdenPagosEgresos;
use App\Model\Administrativo\Contabilidad\Puc;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Registro\Registro;
use Session;
use PDF;
use Carbon\Carbon;

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
            return redirect('/administrativo/ordenPagos/descuento/create/'.$ordenPago->id);
        }
    }

    public function liquidacion($id)
    {
        $Personas = Persona::all();
        foreach ($Personas as $persona){
            if ($persona->puc_tercero == null){
                $Usuarios[] = collect(['id' => $persona->id, 'name' => $persona->nombre]);
            }
        }
        $PUCs = Puc::all();
        $ordenPago = OrdenPagos::findOrfail($id);
        $ordenPagoDesc = OrdenPagosDescuentos::where('orden_pagos_id',$id)->get();
        $registro = Registro::findOrFail($ordenPago->registros_id);
        $Pagos = OrdenPagos::where('estado','=',1);
        $SumPagos = $Pagos->sum('valor');
        return view('administrativo.ordenpagos.createLiquidacion', compact('ordenPago','registro','SumPagos','ordenPagoDesc','PUCs','Usuarios'));
    }

    public function liquidar(Request $request)
    {
        $ordenPago = OrdenPagos::findOrFail($request->ordenPago_id);
        $registro = Registro::findOrFail($ordenPago->registros_id);
        $puc = Puc::findOrFail($request->PUC);
        $registro->saldo = $registro->saldo - $request->valorPuc;
        $registro->save();
        $ordenPago->estado = "1";
        $ordenPago->valor = $request->valorPuc;
        $ordenPago->saldo = $request->valorPuc;
        $ordenPago->save();
        if ($request->userPuc != "Seleccionar Tercero Para el PUC"){
            $puc->persona_id = $request->userPuc;
            $puc->save();
        }
        $oPP = new OrdenPagosPuc();
        $oPP->puc_id = $request->PUC;
        $oPP->orden_pago_id = $request->ordenPago_id;
        $oPP->valor = $request->valorPuc;
        $oPP->save();

        Session::flash('success','La orden de pago se ha contabilizado exitosamente');
        return redirect('/administrativo/ordenPagos/pay/create/'.$request->ordenPago_id.'/'.$oPP->id);
    }

    public function paySave(Request $request){
        $valReceived =array_sum($request->val);
        $valTotal = $request->Pay;
        $valR =number_format($valReceived,0);
        $valT = number_format($valTotal,0);

        if ($valReceived == $valTotal){
            $OPE = new OrdenPagosEgresos();
            $OPE->num = $request->num_cuenta;
            if ($request->type_pay == "1"){
                $OPE->type_pay = "CHEQUE";
            }elseif ($request->type_pay == "2"){
                $OPE->type_pay = "ACCOUNT";
            }
            $OPE->save();
            for($i=0;$i< count($request->banco); $i++){
                $OPPay = new OrdenPagosPayments();
                $OPPay->orden_pago_id = $request->OP;
                $OPPay->puc_id = $request->banco[$i];
                if ($request->type_pay == "1"){
                    $OPPay->num = $request->num_cheque;
                    $OPPay->type_pay = "CHEQUE";
                }elseif ($request->type_pay == "2"){
                    $OPPay->num = $request->num_cuenta;
                    $OPPay->type_pay = "ACCOUNT";
                }
                $OPPay->valor = $request->val[$i];
                $OPPay->orden_pago_egreso_id->$OPE->id;
                $OPPay->save();
            }

            $OP = OrdenPagos::findOrFail($request->OP);
            $OP->saldo = $OP->saldo - $valReceived;
            $OP->save();

            Session::flash('success','La orden de pago se ha finalizado exitosamente');
            return redirect('/administrativo/ordenPagos/'.$request->OP);
        } elseif ($valReceived > $valTotal){
            Session::flash('warning','El valor que va a pagar: $'.$valR.' es mayor al valor correspondiente del pago: $'.$valT);
            return back();
        } else{
            Session::flash('warning','El valor que va a pagar: $'.$valR.' es menor al valor correspondiente del pago: $'.$valT);
            return back();
        }
    }

    public function pay($id, $id2){
        $OP = OrdenPagos::findOrFail($id);
        $OPP = OrdenPagosPuc::findOrFail($id2);
        $PUCS = Puc::where('id','<=',10)->get();

        return view('administrativo.ordenpagos.createPay', compact('OPP','OP','PUCS'));
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
        $R = Registro::findOrFail($OrdenPago->registros_id);

        $all_rubros = Rubro::all();
        foreach ($all_rubros as $rubro){
            if ($rubro->fontsRubro->sum('valor_disp') != 0){
                $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
                $rubros[] = collect(['id' => $rubro->id, 'name' => $rubro->name]);
            }
        }

        //codigo de rubros

        $vigens = Vigencia::where('id', '>',0)->get();
        foreach ($vigens as $vigen) {
            $V = $vigen->id;
        }
        $vigencia_id = $V;

        $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
        $registers = Register::where('level_id', $ultimoLevel->id)->get();
        $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
        $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
        $rubroz = Rubro::where('vigencia_id', $vigencia_id)->get();

        global $lastLevel;
        $lastLevel = $ultimoLevel->id;
        $lastLevel2 = $ultimoLevel2->level_id;
        foreach ($registers2 as $register2) {
            global $codigoLast;
            if ($register2->register_id == null) {
                $codigoEnd = $register2->code;
            } elseif ($codigoLast > 0) {
                if ($lastLevel2 == $register2->level_id) {
                    $codigo = $register2->code;
                    $codigoEnd = "$codigoLast$codigo";
                    foreach ($registers as $register) {
                        if ($register2->id == $register->register_id) {
                            $register_id = $register->code_padre->registers->id;
                            $code = $register->code_padre->registers->code . $register->code;
                            $ultimo = $register->code_padre->registers->level->level;
                            while ($ultimo > 1) {
                                $registro = Register::findOrFail($register_id);
                                $register_id = $registro->code_padre->registers->id;
                                $code = $registro->code_padre->registers->code . $code;

                                $ultimo = $registro->code_padre->registers->level->level;
                            }
                            if ($register->level_id == $lastLevel) {
                                foreach ($rubroz as $rub) {
                                    if ($register->id == $rub->register_id) {
                                        $newCod = "$code$rub->cod";
                                        $infoRubro[] = collect(['id_rubro' => $rub->id, 'id' => '', 'codigo' => $newCod, 'name' => $rub->name, 'code' => $rub->code]);
                                    }
                                }
                            }
                        }
                    }
                }
            }else {
                $codigo = $register2->code;
                $newRegisters = Register::findOrFail($register2->register_id);
                $codigoNew = $newRegisters->code;
                $codigoEnd = "$codigoNew$codigo";
                $codigoLast = $codigoEnd;
            }
        }

        return view('administrativo.ordenpagos.show', compact('OrdenPago','OrdenPagoDescuentos','R','infoRubro'));
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

    public function pdf_OP($id)
    {
        $OrdenPago = OrdenPagos::findOrFail($id);
        $OrdenPagoDescuentos = OrdenPagosDescuentos::where('orden_pagos_id', $id)->get();
        $R = Registro::findOrFail($OrdenPago->registros_id);

        $all_rubros = Rubro::all();
        foreach ($all_rubros as $rubro){
            if ($rubro->fontsRubro->sum('valor_disp') != 0){
                $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
                $rubros[] = collect(['id' => $rubro->id, 'name' => $rubro->name]);
            }
        }

        //codigo de rubros

        $vigens = Vigencia::where('id', '>',0)->get();
        foreach ($vigens as $vigen) {
            $V = $vigen->id;
        }
        $vigencia_id = $V;

        $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
        $registers = Register::where('level_id', $ultimoLevel->id)->get();
        $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
        $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
        $rubroz = Rubro::where('vigencia_id', $vigencia_id)->get();

        global $lastLevel;
        $lastLevel = $ultimoLevel->id;
        $lastLevel2 = $ultimoLevel2->level_id;
        foreach ($registers2 as $register2) {
            global $codigoLast;
            if ($register2->register_id == null) {
                $codigoEnd = $register2->code;
            } elseif ($codigoLast > 0) {
                if ($lastLevel2 == $register2->level_id) {
                    $codigo = $register2->code;
                    $codigoEnd = "$codigoLast$codigo";
                    foreach ($registers as $register) {
                        if ($register2->id == $register->register_id) {
                            $register_id = $register->code_padre->registers->id;
                            $code = $register->code_padre->registers->code . $register->code;
                            $ultimo = $register->code_padre->registers->level->level;
                            while ($ultimo > 1) {
                                $registro = Register::findOrFail($register_id);
                                $register_id = $registro->code_padre->registers->id;
                                $code = $registro->code_padre->registers->code . $code;

                                $ultimo = $registro->code_padre->registers->level->level;
                            }
                            if ($register->level_id == $lastLevel) {
                                foreach ($rubroz as $rub) {
                                    if ($register->id == $rub->register_id) {
                                        $newCod = "$code$rub->cod";
                                        $infoRubro[] = collect(['id_rubro' => $rub->id, 'id' => '', 'codigo' => $newCod, 'name' => $rub->name, 'code' => $rub->code]);
                                    }
                                }
                            }
                        }
                    }
                }
            }else {
                $codigo = $register2->code;
                $newRegisters = Register::findOrFail($register2->register_id);
                $codigoNew = $newRegisters->code;
                $codigoEnd = "$codigoNew$codigo";
                $codigoLast = $codigoEnd;
            }
        }

        $fecha = Carbon::createFromTimeString($OrdenPago->created_at);
        $fechaR = Carbon::createFromTimeString($R->created_at);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = PDF::loadView('administrativo.ordenpagos.pdfOP', compact('OrdenPago','OrdenPagoDescuentos','R','infoRubro', 'dias', 'meses', 'fecha','fechaR'))->setOptions(['images' => true,'isRemoteEnabled' => true]);
        return $pdf->stream();
    }

    public function pdf_CE($id)
    {
        $OrdenPago = OrdenPagos::findOrFail($id);
        $Egreso_id = $OrdenPago->payments[0]->egreso->id;
        $OrdenPagoDescuentos = OrdenPagosDescuentos::where('orden_pagos_id', $id)->get();
        $R = Registro::findOrFail($OrdenPago->registros_id);

        $all_rubros = Rubro::all();
        foreach ($all_rubros as $rubro){
            if ($rubro->fontsRubro->sum('valor_disp') != 0){
                $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
                $rubros[] = collect(['id' => $rubro->id, 'name' => $rubro->name]);
            }
        }

        //codigo de rubros

        $vigens = Vigencia::where('id', '>',0)->get();
        foreach ($vigens as $vigen) {
            $V = $vigen->id;
        }
        $vigencia_id = $V;

        $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
        $registers = Register::where('level_id', $ultimoLevel->id)->get();
        $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
        $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
        $rubroz = Rubro::where('vigencia_id', $vigencia_id)->get();

        global $lastLevel;
        $lastLevel = $ultimoLevel->id;
        $lastLevel2 = $ultimoLevel2->level_id;
        foreach ($registers2 as $register2) {
            global $codigoLast;
            if ($register2->register_id == null) {
                $codigoEnd = $register2->code;
            } elseif ($codigoLast > 0) {
                if ($lastLevel2 == $register2->level_id) {
                    $codigo = $register2->code;
                    $codigoEnd = "$codigoLast$codigo";
                    foreach ($registers as $register) {
                        if ($register2->id == $register->register_id) {
                            $register_id = $register->code_padre->registers->id;
                            $code = $register->code_padre->registers->code . $register->code;
                            $ultimo = $register->code_padre->registers->level->level;
                            while ($ultimo > 1) {
                                $registro = Register::findOrFail($register_id);
                                $register_id = $registro->code_padre->registers->id;
                                $code = $registro->code_padre->registers->code . $code;

                                $ultimo = $registro->code_padre->registers->level->level;
                            }
                            if ($register->level_id == $lastLevel) {
                                foreach ($rubroz as $rub) {
                                    if ($register->id == $rub->register_id) {
                                        $newCod = "$code$rub->cod";
                                        $infoRubro[] = collect(['id_rubro' => $rub->id, 'id' => '', 'codigo' => $newCod, 'name' => $rub->name, 'code' => $rub->code]);
                                    }
                                }
                            }
                        }
                    }
                }
            }else {
                $codigo = $register2->code;
                $newRegisters = Register::findOrFail($register2->register_id);
                $codigoNew = $newRegisters->code;
                $codigoEnd = "$codigoNew$codigo";
                $codigoLast = $codigoEnd;
            }
        }

        $fecha = Carbon::createFromTimeString($OrdenPago->payments[0]->egreso->created_at);
        $fechaO = Carbon::createFromTimeString($OrdenPago->created_at);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = PDF::loadView('administrativo.ordenpagos.pdfCE', compact('OrdenPago','OrdenPagoDescuentos','R','infoRubro', 'dias', 'meses', 'fecha','fechaO','Egreso_id'))->setOptions(['images' => true,'isRemoteEnabled' => true]);
        return $pdf->stream();
    }
}
