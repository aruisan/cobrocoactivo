<?php

namespace App\Http\Controllers\Administrativo\Cdp;

use App\Model\Administrativo\Cdp\RubrosCdpValor;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Administrativo\Registro\CdpsRegistro;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Administrativo\Cdp\RubrosCdp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use PDF;
use Carbon\Carbon;


use Session;
class CdpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $vigencia_id = $id;
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        if ($rol == 2)
        {
            $cdpTarea = Cdp::where('vigencia_id', $vigencia_id)->where('secretaria_e', '0')->orWhere('jefe_e','1')->get();
            $cdps = Cdp::where('vigencia_id', $id)
            ->where(function ($query) {
                $query->where('jefe_e','3')
                    ->orWhere('jefe_e','2');
            })->get();


        }elseif ($rol == 3)
        {
            $cdpTarea = Cdp::where('vigencia_id', $vigencia_id)->where('jefe_e','0')->get();
            $cdps = Cdp::where('vigencia_id', $id)
                ->where(function ($query) {
                    $query->where('jefe_e','3')
                        ->orWhere('jefe_e','2');
                })->get();
        } else
        {
            $cdpTarea = null;
            $cdps = null;
        }
        //this change fix the problem with the count
        if ($cdpTarea == null){
            $cdpTarea = [];
        }
        if ($cdps == null){
            $cdps = [];
        }
        return view('administrativo.cdp.index', compact('cdps','rol', 'cdpTarea','vigencia_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $vigencia = $id;
        $rubros = Rubro::all();
        $dependencia = auth()->user()->dependencia_id;
        return view('administrativo.cdp.create', compact('dependencia','rubros','id'));
    }

    public function anular($id, $vigen){
        $cdp = Cdp::findOrFail($id);
        $cdpsRegistro = CdpsRegistro::where('cdp_id','=',$id)->get();
        if (count($cdpsRegistro) > 0){
            Session::flash('warning', 'Tiene Registros Relacionados al CDP. Elimine los Registros Para Poder Anular el CDP');
            return redirect('/administrativo/cdp/'.$vigen.'/'.$id);
        }else{
            $valor = $cdp->valor;
            $cdp->saldo = 0;
            $cdp->jefe_e = '2';
            $cdp->save();

            $rubrosCdp = RubrosCdpValor::where('cdp_id', $id)->get();
            foreach ($rubrosCdp as $rubroCdp){
               $fontR = FontsRubro::findOrFail($rubroCdp->fontsRubro->id);
               $fontR->valor_disp = $fontR->valor_disp + $rubroCdp->valor;
               $fontR->save();
            }

            Session::flash('error','El CDP ha sido anulado');
            return redirect('/administrativo/cdp/'.$vigen.'/'.$id);
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
        $cdp = new Cdp();
        $cdp->name = $request->name;
        $cdp->valor = 0;
        $cdp->fecha = $request->fecha;
        $cdp->dependencia_id = $request->dependencia_id;
        $cdp->observacion = $request->observacion;
        $cdp->saldo = 0;
        $cdp->secretaria_e = $request->secretaria_e;
        $cdp->ff_secretaria_e = $request->fecha;
        $cdp->vigencia_id = $request->vigencia_id;
        $cdp->save();
        Session::flash('success','El CDP se ha creado exitosamente');
        return redirect('/administrativo/cdp/'.$request->vigencia_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function show($vigencia,$id)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $cdp = Cdp::findOrFail($id);
        $all_rubros = Rubro::where('vigencia_id',$vigencia)->get();
        foreach ($all_rubros as $rubro){
            if ($rubro->fontsRubro->sum('valor_disp') != 0){
                $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
                $rubros[] = collect(['id' => $rubro->id, 'name' => $rubro->name]);
            }
        }

        //codigo de rubros

        $vigens = Vigencia::findOrFail($vigencia);
        $V = $vigens->id;
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
        return view('administrativo.cdp.show', compact('cdp','rubros','valores','rol','infoRubro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function edit($vigen, $cdp)
    {
        $idcdp = Cdp::find($cdp);
        $rubros = Rubro::all();
        return view('administrativo.cdp.edit', compact('idcdp','rubros','vigen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idcdp, $vigen)
    {
        $store= Cdp::findOrFail($idcdp);
        $store->name = $request->name;
        $store->observacion = $request->observacion;
        $store->save();

        Session::flash('success','El CDP '.$request->name.' se edito exitosamente.');
        return  redirect('../administrativo/cdp/'.$vigen);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cdp  $cdp
     * @return \Illuminate\Http\Response
     */
    public function destroy($vigen, $id)
    {
        $borrar = Cdp::find($id);
        $borrar->delete();

        Session::flash('error','CDP borrado correctamente');
        return redirect('../administrativo/cdp/'.$vigen);
    }

    public function updateEstado($id,$rol,$fecha,$valor,$estado)
    {
        $update = Cdp::findOrFail($id);
        if ($rol == 2){
            $update->secretaria_e = $estado;
            $update->jefe_e = "0";
            $update->ff_secretaria_e = $fecha;
            $update->save();

            Session::flash('success','El CDP ha sido enviado exitosamente');
            return redirect('/administrativo/cdp/'.$update->vigencia_id);
        }
        if ($rol == 3){
            if ($estado == 3){
                foreach ($update->rubrosCdpValor as $fuentes){
                    if ($fuentes->fontsRubro->valor_disp >= $fuentes->valor  ){
                        $update->jefe_e = $estado;
                        $update->ff_jefe_e = $fecha;
                        $update->valor = $valor;
                        $update->saldo = $valor;

                        $this->actualizarValorRubro($id);

                        $update->save();

                        Session::flash('success','El CDP ha sido finalizado con exito');
                        return redirect('/administrativo/cdp/'.$update->vigencia_id);
                    } else {
                        Session::flash('error','El CDP no puede tener un valor superior al valor disponible en el rubro');
                        return redirect('/administrativo/cdp/'.$update->vigencia_id.'/'.$id);
                    }
                }
            }
        }
    }

    public function rechazar(Request $request, $id, $vigen)
    {
        if ($request->rol == "3"){
            $update = Cdp::findOrFail($id);
            $update->jefe_e = "1";
            $update->secretaria_e = "0";
            $update->ff_jefe_e = $request->fecha;
            $update->motivo = $request->motivo;
            $update->save();

            Session::flash('error','El CDP ha sido rechazado');
            return redirect('/administrativo/cdp/'.$vigen);
        }
    }

    public function actualizarValorRubro($id)
    {
        $cdp = Cdp::findOrFail($id);
        foreach ($cdp->rubrosCdpValor as $fuentes){
            $valor = $fuentes->valor;
            $total = $fuentes->fontsRubro->valor_disp - $valor;
            $fontRubro = FontsRubro::findOrFail($fuentes->fontsRubro->id);
            $fontRubro->valor_disp = $total;
            $fontRubro->save();
        }
    }


    public function pdf($id, $vigen)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $cdp = Cdp::findOrFail($id);
        $all_rubros = Rubro::all();
        foreach ($all_rubros as $rubro){
            if ($rubro->fontsRubro->sum('valor_disp') != 0){
                $valFuente = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                $valores[] = collect(['id_rubro' => $rubro->id, 'name' => $rubro->name, 'dinero' => $valFuente]);
                $rubros[] = collect(['id' => $rubro->id, 'name' => $rubro->name]);
            }
        }

        //codigo de rubros

        $V = $vigen;

        $vigencia_id = $V;
        $vigencia = Vigencia::find($vigencia_id);

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

        $fecha = Carbon::createFromTimeString($cdp->created_at);

        
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = PDF::loadView('administrativo.cdp.pdf', compact('cdp','rubros','valores','rol','infoRubro', 'vigencia', 'dias', 'meses', 'fecha'))->setOptions(['images' => true,'isRemoteEnabled' => true]);
        return $pdf->stream();
    }
}
