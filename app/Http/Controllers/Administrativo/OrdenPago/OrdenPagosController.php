<?php

namespace App\Http\Controllers\Administrativo\OrdenPago;

use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Model\Administrativo\Contabilidad\RegistersPuc;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos;
use App\Model\Administrativo\OrdenPago\OrdenPagosPuc;
use App\Model\Administrativo\OrdenPago\OrdenPagosPayments;
use App\Model\Administrativo\OrdenPago\OrdenPagosEgresos;
use App\Model\Administrativo\Contabilidad\Puc;
use App\Model\Administrativo\Contabilidad\RubrosPuc;
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
        $Registros = Registro::where([['secretaria_e', '3'], ['saldo', '>', 0]])->get();
        $PUCs = Puc::all();
        $numOP = count(OrdenPagos::all());
        if ($Registros == null) {
            Session::flash('warning', 'No hay registros disponibles para crear la orden de pago, debe crear un nuevo registro. ');
            return redirect('/administrativo/ordenPagos');
        }elseif ($PUCs == null){
            Session::flash('warning', 'No hay un PUC alamcenado en el software o finalizado, debe disponer de uno para poder realizar una orden de pago. ');
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

        if ($request->ValTOP > $registro_id->saldo){
            Session::flash('warning','El valor no puede ser superior al valor disponible del registro seleccionado: '.$registro_id->saldo.' Rectifique el valor de la orden de pago y el iva.');
            return redirect('/administrativo/ordenPagos/create');
        } else {
            $ordenPago = new OrdenPagos();
            $ordenPago->nombre = $request->concepto;
            $ordenPago->valor = $request->ValTOP;
            $ordenPago->saldo = $request->ValTOP;
            $ordenPago->iva = $request->ValIOP;
            $ordenPago->estado = $request->estado;
            $ordenPago->registros_id = $request->IdR;
            $ordenPago->user_id = auth()->user()->id;
            $ordenPago->save();

            Session::flash('success','La orden de pago se ha creado exitosamente');
            return redirect('/administrativo/ordenPagos/monto/create/'.$ordenPago->id);
        }
    }

    public function liquidacion($id)
    {
        $ordenPago = OrdenPagos::findOrfail($id);
        if ($ordenPago->descuentos->count() == 0){
            Session::flash('warning',' Se deben realizar primero los descuentos para poder hacer la contabilización de la orden de pago.');
            return redirect('administrativo/ordenPagos/descuento/create/'.$ordenPago->id);
        }else{
            $Usuarios = Persona::all();
            $data = Puc::all()->first();
            $puc_id = $data->id;
            $ultimoLevel = LevelPUC::where('puc_id', $puc_id)->get()->last();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;

            $R1 = RegistersPuc::where('register_puc_id', NULL)->get();

            foreach ($R1 as $r1) {
                $codigoEnd = $r1->code;
                $codigos[] = collect(['id' => $r1->id, 'codigo' => $codigoEnd, 'name' => $r1->name, 'register_id' => $r1->register_puc_id, 'code_N' =>  '', 'name_N' => '', 'naturaleza' => '','per_id' => '']);
                foreach ($r1->codes as $data1){
                    $reg0 = RegistersPuc::findOrFail($data1->registers_puc_id);
                    $codigo = $reg0->code;
                    $codigoEnd = "$r1->code$codigo";
                    $codigos[] = collect(['id' => $reg0->id, 'codigo' => $codigoEnd, 'name' => $reg0->name, 'register_id' => $reg0->register_puc_id, 'code_N' =>  '', 'name_N' => '', 'naturaleza' => '','per_id' => '']);
                    if ($reg0->codes){
                        foreach ($reg0->codes as $data3){
                            $reg = RegistersPuc::findOrFail($data3->registers_puc_id);
                            $codigo = $reg->code;
                            $codigoF = "$codigoEnd$codigo";
                            $codigos[] = collect(['id' => $reg->id, 'codigo' => $codigoF, 'name' => $reg->name, 'register_id' => $reg->register_puc_id, 'code_N' =>  '', 'name_N' => '', 'naturaleza' => '','per_id' => '']);
                            foreach ($reg->codes as $data4){
                                $reg1 = RegistersPuc::findOrFail($data4->registers_puc_id);
                                $codigo = $reg1->code;
                                $code = "$codigoF$codigo";
                                $codigos[] = collect(['id' => $reg1->id, 'codigo' => $code, 'name' => $reg1->name, 'register_id' => $reg1->register_puc_id, 'code_N' =>  '', 'name_N' => '', 'naturaleza' => '','per_id' => '']);
                                foreach ($reg1->rubro as $rubro){
                                    $codigo = $rubro->codigo;
                                    $code1 = "$code$codigo";
                                    $codigos[] = collect(['id' => $rubro->id, 'codigo' => $code1, 'name' => $rubro->nombre_cuenta, 'code' => $rubro->codigo, 'code_N' =>  $rubro->codigo_NIPS, 'name_N' => $rubro->nombre_NIPS, 'naturaleza' => $rubro->naturaleza,'per_id' => $rubro->persona_id, 'register_id' => $rubro->registers_puc_id]);
                                }
                            }
                        }
                    }
                }
            }
            $ordenPagoDesc = OrdenPagosDescuentos::where('orden_pagos_id',$id)->get();
            $registro = Registro::findOrFail($ordenPago->registros_id);
            $Pagos = OrdenPagos::where('estado','=',1);
            $SumPagos = $Pagos->sum('valor');

            return view('administrativo.ordenpagos.createLiquidacion', compact('ordenPago','registro','SumPagos','ordenPagoDesc','Usuarios','codigos'));
        }
    }

    public function liquidar(Request $request)
    {
        $ordenPago = OrdenPagos::findOrFail($request->ordenPago_id);
        $registro = Registro::findOrFail($ordenPago->registros_id);
        for ($i=0;$i< count($request->PUC); $i++){
            if ($request->PUC[$i] == "Selecciona un PUC"){
                Session::flash('warning','Recuerde seleccionar un PUC antes de continuar');
                return back();
            }else{
                $totalDeb = array_sum($request->valorPucD);
                $totalCred = array_sum($request->valorPucC);
                $totalDes = $ordenPago->descuentos->sum('valor');
                if ( $totalCred + $totalDes == $totalDeb){
                    $registro->saldo = $registro->saldo - $request->valorPucD[$i];
                    $registro->save();
                    $oPP = new OrdenPagosPuc();
                    $oPP->rubros_puc_id = $request->PUC[$i];
                    $oPP->orden_pago_id = $request->ordenPago_id;
                    $oPP->valor_debito = $request->valorPucD[$i];
                    $oPP->valor_credito = $request->valorPucC[$i];
                    $oPP->save();
                } else {
                    Session::flash('warning','Recuerde que los totales del credito y debito deben dar sumas iguales');
                    return back();
                }
            }
        }
        $ordenPago->estado = "1";
        $ordenPago->save();
        Session::flash('success','La orden de pago se ha finalizado exitosamente');
        return redirect('/administrativo/ordenPagos/'.$request->ordenPago_id);
    }

    public function paySave(Request $request){
        $valReceived =array_sum($request->val);
        $valTotal = $request->Pay;
        $valR =number_format($valReceived,0);
        $valT = number_format($valTotal,0);

        if ($valReceived == $valTotal){
            $OPE = new OrdenPagosEgresos();
            if ($request->type_pay == "1"){
                $OPE->type_pay = "CHEQUE";
                $OPE->num = $request->num_cheque;
            }elseif ($request->type_pay == "2"){
                $OPE->type_pay = "ACCOUNT";
                $OPE->num = $request->num_cuenta;
            }
            $OPE->save();
            for($i=0;$i< count($request->banco); $i++){
                $OPPay = new OrdenPagosPayments();
                $OPPay->orden_pago_id = $request->OP;
                $OPPay->rubros_puc_id = $request->banco[$i];
                if ($request->type_pay == "1"){
                    $OPPay->num = $request->num_cheque;
                    $OPPay->type_pay = "CHEQUE";
                }elseif ($request->type_pay == "2"){
                    $OPPay->num = $request->num_cuenta;
                    $OPPay->type_pay = "ACCOUNT";
                }
                $OPPay->valor = $request->val[$i];
                $OPPay->orden_pago_egreso_id = $OPE->id;
                $OPPay->save();
            }

            $OP = OrdenPagos::findOrFail($request->OP);
            $OP->estado = "1";
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

    public function pay($id){
        $OP = OrdenPagos::findOrFail($id);
        $OPP = $OP->pucs;
        $PUCS = RubrosPuc::where('naturaleza','1')->get();

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

    public function deleteRF($id){

        $retenF = OrdenPagosDescuentos::findOrFail($id);
        $retenF->delete();
        Session::flash('error','Descuento de la Retención de Fuente eliminado de la Orden de Pago');
    }

    public function deleteM($id){

        $municipal = OrdenPagosDescuentos::findOrFail($id);
        $municipal->delete();
        Session::flash('error','Descuento Municipal eliminado de la Orden de Pago');
    }

    public function deleteP($id){
        $puc = OrdenPagosPuc::findOrFail($id);
        $puc->delete();
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
        $Egreso_id = $OrdenPago->pago->id;
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

        $fecha = Carbon::createFromTimeString($OrdenPago->pago->created_at);
        $fechaO = Carbon::createFromTimeString($OrdenPago->created_at);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = PDF::loadView('administrativo.ordenpagos.pdfCE', compact('OrdenPago','OrdenPagoDescuentos','R','infoRubro', 'dias', 'meses', 'fecha','fechaO','Egreso_id'))->setOptions(['images' => true,'isRemoteEnabled' => true]);
        return $pdf->stream();
    }
}
