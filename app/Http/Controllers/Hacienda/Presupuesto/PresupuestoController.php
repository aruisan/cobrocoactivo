<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Hacienda\Presupuesto\RubrosMov;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Hacienda\Presupuesto\FontsVigencia;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Administrativo\Registro\Registro;
use App\Model\Administrativo\OrdenPago\OrdenPagos;
use App\Model\Administrativo\OrdenPago\OrdenPagosRubros;
use App\Model\Administrativo\Pago\Pagos;
use App\Model\Administrativo\Pago\PagoRubros;
use App\Model\Hacienda\Presupuesto\Informes\CodeContractuales;


class PresupuestoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:presupuesto-list');
    }


    public function index(){
        $añoActual = Carbon::now()->year;
        $mesActual = Carbon::now()->month;
        $vigens = Vigencia::where('vigencia', $añoActual)->where('tipo', 0)->where('estado', '0')->get();

        if ($vigens->count() == 0){
            $V = "Vacio";
            return view('hacienda.presupuesto.index', compact('V', 'añoActual','mesActual'));
        } else {
            $V = $vigens[0]->id;
            $vigencia_id = $V;
            $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
            $registers = Register::where('level_id', $ultimoLevel->id)->get();
            $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
            $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
            $fonts = FontsVigencia::where('vigencia_id',$vigencia_id)->get();
            $rubros = Rubro::where('vigencia_id', $vigencia_id)->get();
            $fontsRubros = FontsRubro::orderBy('font_vigencia_id')->get();
            $allRegisters = Register::orderByDesc('level_id')->get();
            $pagos = Pagos::all();
            $ordenPagos = OrdenPagos::all();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;
            $lastLevel2 = $ultimoLevel2->level_id;

            foreach ($fonts as $font){
                $fuentes[] = collect(['id' => $font->font->id, 'name' => $font->font->name, 'code' => $font->font->code]);
            }

            foreach ($fontsRubros as $fontsRubro){
                if ($fontsRubro->fontVigencia->vigencia_id == $vigencia_id){
                    $fuentesRubros[] = collect(['valor' => $fontsRubro->valor, 'rubro_id' => $fontsRubro->rubro_id, 'font_vigencia_id' => $fontsRubro->font_vigencia_id]);
                }
            }
            $tamFountsRubros = count($fuentesRubros);

            foreach ($registers2 as $register2) {
                if ($register2->level->vigencia_id == $vigencia_id) {
                    global $codigoLast;
                    if ($register2->register_id == null) {
                        $codigoEnd = $register2->code;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    } elseif ($codigoLast > 0) {
                        if ($lastLevel2 == $register2->level_id) {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
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
                                    $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                                    if ($register->level_id == $lastLevel) {
                                        foreach ($rubros as $rubro) {
                                            if ($register->id == $rubro->register_id) {
                                                $newCod = "$code$rubro->cod";
                                                $fR = $rubro->FontsRubro;
                                                //dd($newCod, $fR);
                                                for ($i = 0; $i < $tamFountsRubros; $i++) {
                                                    $rubrosF = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->orderBy('font_vigencia_id')->get();
                                                    $numR = count($rubrosF);
                                                    $numF = count($fonts);
                                                    if ($numR == $numF) {
                                                        if ($fuentesRubros[$i]['rubro_id'] == $rubro->id) {
                                                            $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $fuentesRubros[$i]['font_vigencia_id']]);
                                                        }
                                                    } else {
                                                        foreach ($fonts as $font) {
                                                            if ($fuentesRubros[$i]['font_vigencia_id'] == $font->id) {
                                                                $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'font_vigencia_id' => $font->id]);
                                                            } else {
                                                                $findFont = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->where('font_vigencia_id', $font->id)->get();
                                                                $numFinds = count($findFont);
                                                                if ($numFinds >= 1) {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id + 1;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                } else {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                $valFuent = FontsRubro::where('rubro_id', $rubro->id)->sum('valor');
                                                $codigos[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id]);
                                                $valDisp = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                                                $Rubros[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id, 'valor_disp' => $valDisp]);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigoLast = $codigoEnd;
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                        }
                    } else {
                        $codigo = $register2->code;
                        $newRegisters = Register::findOrFail($register2->register_id);
                        $codigoNew = $newRegisters->code;
                        $codigoEnd = "$codigoNew$codigo";
                        $codigoLast = $codigoEnd;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    }
                }
            }

            //VALOR DEL PRESUPUESTO INICIAL

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresIniciales); $i++) {
                            if ($valoresIniciales[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresIniciales[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LAS ADICIONES

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valAdd = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"2")->sum('valor');
                            $ArraytotalAdd[] = $valAdd;
                        }
                        if (isset($ArraytotalAdd)) {
                            $totalAdd = array_sum($ArraytotalAdd);
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => $totalAdd, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalAdd);
                        } else {
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinAdd); $i++) {
                            if ($valoresFinAdd[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinAdd[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LAS REDUCCIONES

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valRed = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"3")->sum('valor');
                            $ArraytotalRed[] = $valRed;
                        }
                        if (isset($ArraytotalRed)) {
                            $totalRed = array_sum($ArraytotalRed);
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => $totalRed, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalRed);
                        } else {
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinRed); $i++) {
                            if ($valoresFinRed[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinRed[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            // VALOR TOTAL DE LOS CREDITOS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valCred = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"1")->sum('valor');
                            $ArraytotalCred[] = $valCred;
                        }
                        if (isset($ArraytotalCred)) {
                            $totalCred = array_sum($ArraytotalCred);
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => $totalCred, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCred);
                        } else {
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCred); $i++) {
                            if ($valoresFinCred[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCred[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            // VALOR TOTAL DE LOS CONTRACREDITOS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            foreach ($rubrosReg->fontsRubro as $FR){
                                foreach ($FR->rubrosMov as $movR){
                                    if ($movR->movimiento == 1){
                                        $ArraytotalCCred[] = $movR->valor;
                                    }
                                }
                            }
                        }
                        if (isset($ArraytotalCCred)) {
                            $totalCCred = array_sum($ArraytotalCCred);
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => $totalCCred, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCCred);
                        } else {
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCCred); $i++) {
                            if ($valoresFinCCred[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCCred[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE CDPS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            foreach ($rubrosReg->rubrosCdp as $Rcdp){
                                $cdpInfo = Cdp::where('id', $Rcdp->cdps->id)->where('jefe_e', '!=', 3)->get();
                                if ($cdpInfo->count() > 0 ){
                                    $ArraytotalCdp[] = $Rcdp->cdps->valor;
                                }
                            }
                        }
                        if (isset($ArraytotalCdp)) {
                            $totalCdp = array_sum($ArraytotalCdp);
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => $totalCdp, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCdp);
                        } else {
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCdp); $i++) {
                            if ($valoresFinCdp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCdp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LOS REGISTROS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosFReg = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosFReg as $rubro) {
                            if ($rubro->cdpRegistroValor->count() == 0){
                                $ArraytotalReg[] =  0 ;
                            }elseif ($rubro->cdpRegistroValor->count() > 1){
                                $ArraytotalReg[] = $rubro->cdpRegistroValor->sum('valor');
                            }else{
                                $reg = $rubro->cdpRegistroValor->first();
                                $ArraytotalReg[] = $reg['valor'];
                            }
                        }
                        if (isset($ArraytotalReg)) {
                            $totalReg = array_sum($ArraytotalReg);
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => $totalReg, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalReg);
                        } else {
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinReg); $i++) {
                            if ($valoresFinReg[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinReg[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //SUMA DE VALOR DISPONIBLE DEL RUBRO - CDP

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor_disp');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valorDisp); $i++) {
                            if ($valorDisp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valorDisp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }
        }

        //VALOR DE LOS CDPS DEL RUBRO
        foreach ($rubros as $R){
            if ($R->rubrosCdp->count() == 0){
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0 ]) ;
            }
            if ($R->rubrosCdp->count() > 1){
                foreach ($R->rubrosCdp as $R3){
                    if ($R3->cdps->jefe_e == "2"){
                        $suma2[] = 0;
                    } else{
                        $suma2[] = $R3->rubrosCdpValor->sum('valor');
                    }
                }
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => array_sum($suma2)]) ;
                unset($suma2);
            }else{
                foreach ($R->rubrosCdp as $R2){
                    if ($R2->cdps->jefe_e == "2"){
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0]) ;
                    }else {
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => $R2->rubrosCdpValor->sum('valor')]) ;
                    }
                }
            }

        }

        //VALOR DE LOS REGISTROS DEL RUBRO
        foreach ($rubros as $rub){
            if ($rub->cdpRegistroValor->count() == 0){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => 0 ]) ;
            }elseif ($rub->cdpRegistroValor->count() > 1){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $rub->cdpRegistroValor->sum('valor')]);
            }else{
                $reg = $rub->cdpRegistroValor->first();
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $reg['valor']]) ;
            }
        }

        //VALORES TOTALES SALDO CDP

        for ($i=0;$i<count($valoresFinCdp);$i++){
            $valorFcdp[] = collect(['id' => $valoresFinCdp[$i]['id'], 'valor' => $valoresFinCdp[$i]['valor'] - $valoresFinReg[$i]['valor']]);
        }


        //VALOR DISPONIBLE CDP - REGISTROS
        for ($i=0;$i<count($valoresCdp);$i++){
            $valorDcdp[] = collect(['id' => $valoresCdp[$i]['id'], 'valor' => $valoresCdp[$i]['valor'] - $valoresRubro[$i]['valor']]);
        }


        //ORDEN DE PAGO

        $OP = OrdenPagosRubros::all();
        if ($OP->count() != 0){
            foreach ($OP as $val){
                $valores[] = ['id' => $val->cdps_registro->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores as $id){
                $ids[] = $id['id'];
            }
            $valores2 = array_unique($ids);
            foreach ($valores2 as $valUni){
                $keys = array_keys(array_column($valores, 'id'), $valUni);
                foreach ($keys as $key){
                    $values[] = $valores[$key]["val"];
                }
                $valoresF[] = ['id' => $valUni, 'valor' => array_sum($values)];
                unset($values);
            }
            foreach ($rubros as $rub){
                $validate = in_array($rub->id, $valores2);
                if ($validate == true ){
                    $data = array_keys(array_column($valoresF, 'id'), $rub->id);
                    $x[] = $valoresF[$data[0]];
                    $valOP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        } else {
            foreach ($rubros as $rub){
                $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //TOTALES ORDEN DE PAGO

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubs as $rubro) {
                        foreach ($valOP as $data){
                            if ($data['id'] == $rubro->id and $data['valor'] != 0){
                                $ArrayTotalOp[] = $data['valor'];
                            }
                        }
                    }
                    if (isset($ArrayTotalOp)) {
                        $totalOp = array_sum($ArrayTotalOp);
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => $totalOp, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArrayTotalOp);
                    } else {
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresFinOp); $i++) {
                        if ($valoresFinOp[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresFinOp[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }

        //PAGOS

        $pagos2 = PagoRubros::all();
        if ($pagos2->count() != 0) {

            foreach ($pagos2 as $val) {
                $valores1[] = ['id' => $val->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores1 as $id1) {
                $ides[] = $id1['id'];
            }
            $valores3 = array_unique($ides);
            foreach ($valores3 as $valUni) {
                $keys = array_keys(array_column($valores1, 'id'), $valUni);
                foreach ($keys as $key) {
                    $values1[] = $valores1[$key]["val"];
                }
                $valoresZ[] = ['id' => $valUni, 'valor' => array_sum($values1)];
                unset($values1);
            }

            foreach ($rubros as $rub) {
                $validate = in_array($rub->id, $valores3);
                if ($validate == true) {
                    $data = array_keys(array_column($valoresZ, 'id'), $rub->id);
                    $x[] = $valoresZ[$data[0]];
                    $valP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        }else {
            foreach ($rubros as $rub) {
                $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //TOTALES PAGOS

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubs as $rubro) {
                        foreach ($valP as $data){
                            if ($data['id'] == $rubro->id and $data['valor'] != 0){
                                $ArrayTotalP[] = $data['valor'];
                            }
                        }
                    }
                    if (isset($ArrayTotalP)) {
                        $totalP = array_sum($ArrayTotalP);
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => $totalP, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArrayTotalP);
                    } else {
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresFinP); $i++) {
                        if ($valoresFinP[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresFinP[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }

        //ADICION
        foreach ($rubros as $R2){
            $ad = RubrosMov::where([['rubro_id', $R2->id],['movimiento', '=', '2']])->get();
            if ($ad->count() > 0){
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => $ad->sum('valor')]) ;
            } else{
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => 0]) ;
            }
        }


        //REDUCCIÓN
        foreach ($rubros as $R3){
            $red = RubrosMov::where([['rubro_id', $R3->id],['movimiento', '=', '3']])->get();
            if ($red->count() > 0){
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => $red->sum('valor')]) ;
            } else{
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => 0]) ;
            }
        }


        //CREDITO
        foreach ($rubros as $R4){
            $cred = RubrosMov::where([['rubro_id', $R4->id],['movimiento', '=', '1']])->get();
            if ($cred->count() > 0){
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => $cred->sum('valor')]) ;
            }else{
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => 0]) ;
            }
        }

        //CONTRACREDITO
        foreach ($rubros as $R5){
            foreach ($R5->fontsRubro as $FR){
                foreach ($FR->rubrosMov as $movR) {
                    if ($movR->movimiento == 1){
                        $suma[] = $movR->valor;
                    }
                }
            }
            if (isset($suma)){
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => array_sum($suma)]);
                unset($suma);
            } else{
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => 0]);
            }
        }

        //CREDITO Y CONTRACREDITO

        for ($i=0;$i<sizeof($valoresCcred);$i++){
            if ($valoresCcred[$i]['id'] == $valoresCred[$i]['id']){
                $valoresCyC[] = collect(['id' => $valoresCcred[$i]['id'], 'valorC' => $valoresCred[$i]['valor'], 'valorCC' => $valoresCcred[$i]['valor']]) ;
            }
        }

        //PRESUPUESTO DEFINITIVO

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubrosRegs as $rubrosReg) {
                        $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                        foreach ($valoresAdd as $valAdd) {
                            if ($rubrosReg->id == $valAdd["id"]) {
                                $valAdicion = $valAdd["valor"];
                            }
                        }
                        foreach ($valoresRed as $valRed) {
                            if ($rubrosReg->id == $valRed["id"]) {
                                $valReduccion = $valRed["valor"];
                            }
                        }
                        foreach ($valoresCred as $valCred) {
                            if ($rubrosReg->id == $valCred["id"]) {
                                $valCredito = $valCred["valor"];
                            }
                        }
                        foreach ($valoresCcred as $valCcred) {
                            if ($rubrosReg->id == $valCcred["id"]) {
                                $valCcredito = $valCcred["valor"];
                            }
                        }
                        if (isset($valAdicion) and isset($valReduccion)) {
                            $ArraytotalFR[] = $valFuent + $valAdicion - $valReduccion + $valCredito - $valCcredito;
                        } else {
                            $ArraytotalFR[] = $valFuent + $valCredito - $valCcredito;
                        }

                    }
                    if (isset($ArraytotalFR)) {
                        $totalFR = array_sum($ArraytotalFR);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArraytotalFR);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresDisp); $i++) {
                        if ($valoresDisp[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresDisp[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }


        foreach ($codigos as $cod){
            if ($cod['valor']){
                foreach ($valoresAdd as $valores1){
                    if ($cod['id_rubro'] == $valores1['id']){
                        $valAd1 = $valores1['valor'];
                    }
                }
                foreach ($valoresRed as $valores2){
                    if ($cod['id_rubro'] == $valores2['id']){
                        $valRed1 = $valores2['valor'];
                    }
                }
                foreach ($valoresCred as $valores3){
                    if ($cod['id_rubro'] == $valores3['id']){
                        $valCred1 = $valores3['valor'];
                    }
                }
                foreach ($valoresCcred as $valores4){
                    if ($cod['id_rubro'] == $valores4['id']){
                        $valCcred1 = $valores4['valor'];
                    }
                }
                if (isset($valAd1) and isset($valRed1)){
                    $AD = $cod['valor'] + $valAd1 - $valRed1 + $valCred1 - $valCcred1;
                } else{
                    $AD = $cod['valor'] + $valCred1 - $valCcred1;
                }
                $ArrayDispon[] = collect(['id' => $cod['id_rubro'], 'valor' => $AD]);
            }
        }

        //SALDO DISPONIBLE

        foreach ($ArrayDispon as $valDisp){
            foreach ($valoresCdp as $valCdp){
                if ($valCdp['id'] == $valDisp['id']){
                    $valrest = $valCdp['valor'];
                }
            }
            $saldoDisp[] = collect(['id' => $valDisp['id'], 'valor' => $valDisp['valor'] - $valrest]);
        }

        //ROL

        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }

        //CUENTAS POR PAGAR

        for ($i=0;$i<sizeof($valOP);$i++){
            $valueTot = $valOP[$i]['valor'] - $valP[$i]['valor'];
            $valCP[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valueTot]);
            unset($valueTot);
        }

        //TOTAL CUENTAS POR PAGAR

        for ($i=0;$i<sizeof($valoresFinOp);$i++){
            $valTot = $valoresFinOp[$i]['valor'] - $valoresFinP[$i]['valor'];
            $valoresFinC[] = collect(['id' => $valoresFinOp[$i]['id'], 'valor' => $valTot]);
            unset($valTot);
        }

        //RESERVAS

        for ($i=0;$i<sizeof($valoresRubro);$i++){
            $valTot = $valoresRubro[$i]['valor'] - $valOP[$i]['valor'];
            $valR[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valTot]);
            unset($valTot);
        }

        //TOTAL RESERVAS

        for ($i=0;$i<sizeof($valoresFinReg);$i++){
            $totally = $valoresFinReg[$i]['valor'] - $valoresFinOp[$i]['valor'];
            $valoresFinRes[] = collect(['id' => $valoresFinOp[$i]['id'], 'valor' => $totally]);
            unset($totally);
        }

        //CODE CONTRACTUALES

        $codeCon = CodeContractuales::all();

        //CDP's

        $cdps= Cdp::where('vigencia_id', $V)->get();

        //REGISTROS
        $registros = Registro::all();

        return view('hacienda.presupuesto.index', compact('codigos','V','fuentes','FRubros','fuentesRubros','valoresIniciales','cdps', 'Rubros','valoresCdp','registros','valorDisp','valoresAdd','valoresRed','valoresDisp','ArrayDispon', 'saldoDisp','rol','valoresCred', 'valoresCcred','valoresCyC','ordenPagos','valoresRubro','valorDcdp','valOP','pagos','valP','valCP','valR','codeCon','añoActual','valoresFinAdd','valoresFinRed','valoresFinCred','valoresFinCCred','valoresFinCdp','valoresFinReg','valorFcdp','valoresFinOp','valoresFinP','valoresFinC','valoresFinRes','mesActual'));
    }


    public function ingresos(){
        $añoActual = Carbon::now()->year;
        $mesActual = Carbon::now()->month;
        $vigens = Vigencia::where('vigencia', $añoActual)->where('tipo', 1)->where('estado', '0')->get();

        if ($vigens->count() == 0){
            $V = "Vacio";
            return view('hacienda.presupuesto.indexIngresos', compact('V', 'añoActual', 'mesActual'));
        } else {
            $V = $vigens[0]->id;
            $vigencia_id = $V;
            $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
            $registers = Register::where('level_id', $ultimoLevel->id)->get();
            $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
            $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
            $fonts = FontsVigencia::where('vigencia_id',$vigencia_id)->get();
            $rubros = Rubro::where('vigencia_id', $vigencia_id)->get();
            $fontsRubros = FontsRubro::orderBy('font_vigencia_id')->get();
            $allRegisters = Register::orderByDesc('level_id')->get();
            $pagos = Pagos::all();
            $ordenPagos = OrdenPagos::all();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;
            $lastLevel2 = $ultimoLevel2->level_id;

            foreach ($fonts as $font){
                $fuentes[] = collect(['id' => $font->font->id, 'name' => $font->font->name, 'code' => $font->font->code]);
            }

            foreach ($fontsRubros as $fontsRubro){
                if ($fontsRubro->fontVigencia->vigencia_id == $vigencia_id){
                    $fuentesRubros[] = collect(['valor' => $fontsRubro->valor, 'rubro_id' => $fontsRubro->rubro_id, 'font_vigencia_id' => $fontsRubro->font_vigencia_id]);
                }
            }
            $tamFountsRubros = count($fuentesRubros);

            foreach ($registers2 as $register2) {
                if ($register2->level->vigencia_id == $vigencia_id) {
                    global $codigoLast;
                    if ($register2->register_id == null) {
                        $codigoEnd = $register2->code;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    } elseif ($codigoLast > 0) {
                        if ($lastLevel2 == $register2->level_id) {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
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
                                    $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                                    if ($register->level_id == $lastLevel) {
                                        foreach ($rubros as $rubro) {
                                            if ($register->id == $rubro->register_id) {
                                                $newCod = "$code$rubro->cod";
                                                $fR = $rubro->FontsRubro;
                                                //dd($newCod, $fR);
                                                for ($i = 0; $i < $tamFountsRubros; $i++) {
                                                    $rubrosF = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->orderBy('font_vigencia_id')->get();
                                                    $numR = count($rubrosF);
                                                    $numF = count($fonts);
                                                    if ($numR == $numF) {
                                                        if ($fuentesRubros[$i]['rubro_id'] == $rubro->id) {
                                                            $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $fuentesRubros[$i]['font_vigencia_id']]);
                                                        }
                                                    } else {
                                                        foreach ($fonts as $font) {
                                                            if ($fuentesRubros[$i]['font_vigencia_id'] == $font->id) {
                                                                $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'font_vigencia_id' => $font->id]);
                                                            } else {
                                                                $findFont = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->where('font_vigencia_id', $font->id)->get();
                                                                $numFinds = count($findFont);
                                                                if ($numFinds >= 1) {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id + 1;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                } else {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                $valFuent = FontsRubro::where('rubro_id', $rubro->id)->sum('valor');
                                                $codigos[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id]);
                                                $valDisp = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                                                $Rubros[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id, 'valor_disp' => $valDisp]);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigoLast = $codigoEnd;
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                        }
                    } else {
                        $codigo = $register2->code;
                        $newRegisters = Register::findOrFail($register2->register_id);
                        $codigoNew = $newRegisters->code;
                        $codigoEnd = "$codigoNew$codigo";
                        $codigoLast = $codigoEnd;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    }
                }
            }
            //Sumas de los Valores
            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresIniciales); $i++) {
                            if ($valoresIniciales[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresIniciales[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //SUMA DE VALOR DISPONIBLE DEL RUBRO - CDP

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor_disp');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valorDisp); $i++) {
                            if ($valorDisp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valorDisp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }
        }

        //VALOR DE LOS CDPS DEL RUBRO
        foreach ($rubros as $R){
            if ($R->rubrosCdp->count() == 0){
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0 ]) ;
            }
            if ($R->rubrosCdp->count() > 1){
                foreach ($R->rubrosCdp as $R3){
                    if ($R3->cdps->jefe_e == "2"){
                        $suma2[] = 0;
                    } else{
                        $suma2[] = $R3->rubrosCdpValor->sum('valor');
                    }
                }
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => array_sum($suma2)]) ;
                unset($suma2);
            }else{
                foreach ($R->rubrosCdp as $R2){
                    if ($R2->cdps->jefe_e == "2"){
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0]) ;
                    }else {
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => $R2->rubrosCdpValor->sum('valor')]) ;
                    }
                }
            }

        }

        //VALOR DE LOS REGISTROS DEL RUBRO
        foreach ($rubros as $rub){
            if ($rub->cdpRegistroValor->count() == 0){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => 0 ]) ;
            }elseif ($rub->cdpRegistroValor->count() > 1){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $rub->cdpRegistroValor->sum('valor')]);
            }else{
                $reg = $rub->cdpRegistroValor->first();
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $reg['valor']]) ;
            }
        }

        //VALOR DISPONIBLE CDP - REGISTROS
        for ($i=0;$i<count($valoresCdp);$i++){
            $valorDcdp[] = collect(['id' => $valoresCdp[$i]['id'], 'valor' => $valoresCdp[$i]['valor'] - $valoresRubro[$i]['valor']]);
        }


        //ORDEN DE PAGO

        $OP = OrdenPagosRubros::all();
        if ($OP->count() != 0){
            foreach ($OP as $val){
                $valores[] = ['id' => $val->cdps_registro->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores as $id){
                $ids[] = $id['id'];
            }
            $valores2 = array_unique($ids);
            foreach ($valores2 as $valUni){
                $keys = array_keys(array_column($valores, 'id'), $valUni);
                foreach ($keys as $key){
                    $values[] = $valores[$key]["val"];
                }
                $valoresF[] = ['id' => $valUni, 'valor' => array_sum($values)];
                unset($values);
            }
            foreach ($rubros as $rub){
                $validate = in_array($rub->id, $valores2);
                if ($validate == true ){
                    $data = array_keys(array_column($valoresF, 'id'), $rub->id);
                    $x[] = $valoresF[$data[0]];
                    $valOP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        } else {
            foreach ($rubros as $rub){
                $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //PAGOS

        $pagos2 = PagoRubros::all();
        if ($pagos2->count() != 0) {

            foreach ($pagos2 as $val) {
                $valores1[] = ['id' => $val->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores1 as $id1) {
                $ides[] = $id1['id'];
            }
            $valores3 = array_unique($ides);
            foreach ($valores3 as $valUni) {
                $keys = array_keys(array_column($valores1, 'id'), $valUni);
                foreach ($keys as $key) {
                    $values1[] = $valores1[$key]["val"];
                }
                $valoresZ[] = ['id' => $valUni, 'valor' => array_sum($values1)];
                unset($values1);
            }

            foreach ($rubros as $rub) {
                $validate = in_array($rub->id, $valores3);
                if ($validate == true) {
                    $data = array_keys(array_column($valoresZ, 'id'), $rub->id);
                    $x[] = $valoresZ[$data[0]];
                    $valP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        }else {
            foreach ($rubros as $rub) {
                $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //ADICION
        foreach ($rubros as $R2){
            $ad = RubrosMov::where([['rubro_id', $R2->id],['movimiento', '=', '2']])->get();
            if ($ad->count() > 0){
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => $ad->sum('valor')]) ;
            } else{
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => 0]) ;
            }
        }


        //REDUCCIÓN
        foreach ($rubros as $R3){
            $red = RubrosMov::where([['rubro_id', $R3->id],['movimiento', '=', '3']])->get();
            if ($red->count() > 0){
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => $red->sum('valor')]) ;
            } else{
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => 0]) ;
            }
        }


        //CREDITO
        foreach ($rubros as $R4){
            $cred = RubrosMov::where([['rubro_id', $R4->id],['movimiento', '=', '1']])->get();
            if ($cred->count() > 0){
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => $cred->sum('valor')]) ;
            }else{
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => 0]) ;
            }
        }

        //CONTRACREDITO
        foreach ($rubros as $R5){
            foreach ($R5->fontsRubro as $FR){
                foreach ($FR->rubrosMov as $movR) {
                    if ($movR->movimiento == 1){
                        $suma[] = $movR->valor;
                    }
                }
            }
            if (isset($suma)){
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => array_sum($suma)]);
                unset($suma);
            } else{
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => 0]);
            }
        }

        //CREDITO Y CONTRACREDITO

        for ($i=0;$i<sizeof($valoresCcred);$i++){
            if ($valoresCcred[$i]['id'] == $valoresCred[$i]['id']){
                $valoresCyC[] = collect(['id' => $valoresCcred[$i]['id'], 'valorC' => $valoresCred[$i]['valor'], 'valorCC' => $valoresCcred[$i]['valor']]) ;
            }
        }

        //PRESUPUESTO DEFINITIVO

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubrosRegs as $rubrosReg) {
                        $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                        foreach ($valoresAdd as $valAdd) {
                            if ($rubrosReg->id == $valAdd["id"]) {
                                $valAdicion = $valAdd["valor"];
                            }
                        }
                        foreach ($valoresRed as $valRed) {
                            if ($rubrosReg->id == $valRed["id"]) {
                                $valReduccion = $valRed["valor"];
                            }
                        }
                        foreach ($valoresCred as $valCred) {
                            if ($rubrosReg->id == $valCred["id"]) {
                                $valCredito = $valCred["valor"];
                            }
                        }
                        foreach ($valoresCcred as $valCcred) {
                            if ($rubrosReg->id == $valCcred["id"]) {
                                $valCcredito = $valCcred["valor"];
                            }
                        }
                        if (isset($valAdicion) and isset($valReduccion)) {
                            $ArraytotalFR[] = $valFuent + $valAdicion - $valReduccion + $valCredito - $valCcredito;
                        } else {
                            $ArraytotalFR[] = $valFuent + $valCredito - $valCcredito;
                        }

                    }
                    if (isset($ArraytotalFR)) {
                        $totalFR = array_sum($ArraytotalFR);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArraytotalFR);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresDisp); $i++) {
                        if ($valoresDisp[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresDisp[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }

        foreach ($codigos as $cod){
            if ($cod['valor']){
                foreach ($valoresAdd as $valores1){
                    if ($cod['id_rubro'] == $valores1['id']){
                        $valAd1 = $valores1['valor'];
                    }
                }
                foreach ($valoresRed as $valores2){
                    if ($cod['id_rubro'] == $valores2['id']){
                        $valRed1 = $valores2['valor'];
                    }
                }
                foreach ($valoresCred as $valores3){
                    if ($cod['id_rubro'] == $valores3['id']){
                        $valCred1 = $valores3['valor'];
                    }
                }
                foreach ($valoresCcred as $valores4){
                    if ($cod['id_rubro'] == $valores4['id']){
                        $valCcred1 = $valores4['valor'];
                    }
                }
                if (isset($valAd1) and isset($valRed1)){
                    $AD = $cod['valor'] + $valAd1 - $valRed1 + $valCred1 - $valCcred1;
                } else{
                    $AD = $cod['valor'] + $valCred1 - $valCcred1;
                }
                $ArrayDispon[] = collect(['id' => $cod['id_rubro'], 'valor' => $AD]);
            }
        }

        //SALDO DISPONIBLE

        foreach ($ArrayDispon as $valDisp){
            foreach ($valoresCdp as $valCdp){
                if ($valCdp['id'] == $valDisp['id']){
                    $valrest = $valCdp['valor'];
                }
            }
            $saldoDisp[] = collect(['id' => $valDisp['id'], 'valor' => $valDisp['valor'] - $valrest]);
        }

        //ROL

        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }

        //CUENTAS POR PAGAR

        for ($i=0;$i<sizeof($valOP);$i++){
            $valueTot = $valOP[$i]['valor'] - $valP[$i]['valor'];
            $valCP[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valueTot]);
            unset($valueTot);
        }

        //RESERVAS

        for ($i=0;$i<sizeof($valoresRubro);$i++){
            $valTot = $valoresRubro[$i]['valor'] - $valOP[$i]['valor'];
            $valR[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valTot]);
            unset($valTot);
        }

        //CODE CONTRACTUALES

        $codeCon = CodeContractuales::all();


        return view('hacienda.presupuesto.indexIngresos', compact('codigos','V','fuentes','FRubros','fuentesRubros','valoresIniciales', 'Rubros','valoresCdp','valorDisp','valoresAdd','valoresRed','valoresDisp','ArrayDispon', 'saldoDisp','rol','valoresCred', 'valoresCcred','valoresCyC','ordenPagos','valoresRubro','valorDcdp','valOP','pagos','valP','valCP','valR','codeCon','añoActual','mesActual'));
    }

    public function newPreIng($id, $year){

        $vigencia = Vigencia::where('tipo',$id)->where('vigencia', $year)->get();
        if ($vigencia->count() == 0){
            return view('hacienda.presupuesto.vigencia.createVigAdelantada',compact('id','year'));
        } else {
            $vigens= Vigencia::findOrFail($vigencia[0]->id);
            $añoActual = $vigens->vigencia;
            $mesActual = Carbon::now()->month;

            $V = $vigens->id;
            $vigencia_id = $V;
            $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
            $registers = Register::where('level_id', $ultimoLevel->id)->get();
            $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
            $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
            $fonts = FontsVigencia::where('vigencia_id',$vigencia_id)->get();
            $rubros = Rubro::where('vigencia_id', $vigencia_id)->get();
            $fontsRubros = FontsRubro::orderBy('font_vigencia_id')->get();
            $allRegisters = Register::orderByDesc('level_id')->get();
            $pagos = Pagos::all();
            $ordenPagos = OrdenPagos::all();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;
            $lastLevel2 = $ultimoLevel2->level_id;

            foreach ($fonts as $font){
                $fuentes[] = collect(['id' => $font->font->id, 'name' => $font->font->name, 'code' => $font->font->code]);
            }

            foreach ($fontsRubros as $fontsRubro){
                if ($fontsRubro->fontVigencia->vigencia_id == $vigencia_id){
                    $fuentesRubros[] = collect(['valor' => $fontsRubro->valor, 'rubro_id' => $fontsRubro->rubro_id, 'font_vigencia_id' => $fontsRubro->font_vigencia_id]);
                }
            }
            $tamFountsRubros = count($fuentesRubros);

            foreach ($registers2 as $register2) {
                if ($register2->level->vigencia_id == $vigencia_id) {
                    global $codigoLast;
                    if ($register2->register_id == null) {
                        $codigoEnd = $register2->code;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    } elseif ($codigoLast > 0) {
                        if ($lastLevel2 == $register2->level_id) {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
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
                                    $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                                    if ($register->level_id == $lastLevel) {
                                        foreach ($rubros as $rubro) {
                                            if ($register->id == $rubro->register_id) {
                                                $newCod = "$code$rubro->cod";
                                                $fR = $rubro->FontsRubro;
                                                //dd($newCod, $fR);
                                                for ($i = 0; $i < $tamFountsRubros; $i++) {
                                                    $rubrosF = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->orderBy('font_vigencia_id')->get();
                                                    $numR = count($rubrosF);
                                                    $numF = count($fonts);
                                                    if ($numR == $numF) {
                                                        if ($fuentesRubros[$i]['rubro_id'] == $rubro->id) {
                                                            $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $fuentesRubros[$i]['font_vigencia_id']]);
                                                        }
                                                    } else {
                                                        foreach ($fonts as $font) {
                                                            if ($fuentesRubros[$i]['font_vigencia_id'] == $font->id) {
                                                                $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'font_vigencia_id' => $font->id]);
                                                            } else {
                                                                $findFont = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->where('font_vigencia_id', $font->id)->get();
                                                                $numFinds = count($findFont);
                                                                if ($numFinds >= 1) {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id + 1;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                } else {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                $valFuent = FontsRubro::where('rubro_id', $rubro->id)->sum('valor');
                                                $codigos[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id]);
                                                $valDisp = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                                                $Rubros[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id, 'valor_disp' => $valDisp]);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigoLast = $codigoEnd;
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                        }
                    } else {
                        $codigo = $register2->code;
                        $newRegisters = Register::findOrFail($register2->register_id);
                        $codigoNew = $newRegisters->code;
                        $codigoEnd = "$codigoNew$codigo";
                        $codigoLast = $codigoEnd;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    }
                }
            }
            //Sumas de los Valores
            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresIniciales); $i++) {
                            if ($valoresIniciales[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresIniciales[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //SUMA DE VALOR DISPONIBLE DEL RUBRO - CDP

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor_disp');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valorDisp); $i++) {
                            if ($valorDisp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valorDisp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }
            //VALOR DE LOS CDPS DEL RUBRO
            foreach ($rubros as $R){
                if ($R->rubrosCdp->count() == 0){
                    $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0 ]) ;
                }
                if ($R->rubrosCdp->count() > 1){
                    foreach ($R->rubrosCdp as $R3){
                        if ($R3->cdps->jefe_e == "2"){
                            $suma2[] = 0;
                        } else{
                            $suma2[] = $R3->rubrosCdpValor->sum('valor');
                        }
                    }
                    $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => array_sum($suma2)]) ;
                    unset($suma2);
                }else{
                    foreach ($R->rubrosCdp as $R2){
                        if ($R2->cdps->jefe_e == "2"){
                            $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0]) ;
                        }else {
                            $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => $R2->rubrosCdpValor->sum('valor')]) ;
                        }
                    }
                }

            }

            //VALOR DE LOS REGISTROS DEL RUBRO
            foreach ($rubros as $rub){
                if ($rub->cdpRegistroValor->count() == 0){
                    $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => 0 ]) ;
                }elseif ($rub->cdpRegistroValor->count() > 1){
                    $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $rub->cdpRegistroValor->sum('valor')]);
                }else{
                    $reg = $rub->cdpRegistroValor->first();
                    $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $reg['valor']]) ;
                }
            }

            //VALOR DISPONIBLE CDP - REGISTROS
            for ($i=0;$i<count($valoresCdp);$i++){
                $valorDcdp[] = collect(['id' => $valoresCdp[$i]['id'], 'valor' => $valoresCdp[$i]['valor'] - $valoresRubro[$i]['valor']]);
            }


            //ORDEN DE PAGO

            $OP = OrdenPagosRubros::all();
            if ($OP->count() != 0){
                foreach ($OP as $val){
                    $valores[] = ['id' => $val->cdps_registro->rubro->id, 'val' => $val->valor];
                }
                foreach ($valores as $id){
                    $ids[] = $id['id'];
                }
                $valores2 = array_unique($ids);
                foreach ($valores2 as $valUni){
                    $keys = array_keys(array_column($valores, 'id'), $valUni);
                    foreach ($keys as $key){
                        $values[] = $valores[$key]["val"];
                    }
                    $valoresF[] = ['id' => $valUni, 'valor' => array_sum($values)];
                    unset($values);
                }
                foreach ($rubros as $rub){
                    $validate = in_array($rub->id, $valores2);
                    if ($validate == true ){
                        $data = array_keys(array_column($valoresF, 'id'), $rub->id);
                        $x[] = $valoresF[$data[0]];
                        $valOP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                        unset($x);
                    } else {
                        $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
                    }
                }
            } else {
                foreach ($rubros as $rub){
                    $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }

            //PAGOS

            $pagos2 = PagoRubros::all();
            if ($pagos2->count() != 0) {

                foreach ($pagos2 as $val) {
                    $valores1[] = ['id' => $val->rubro->id, 'val' => $val->valor];
                }
                foreach ($valores1 as $id1) {
                    $ides[] = $id1['id'];
                }
                $valores3 = array_unique($ides);
                foreach ($valores3 as $valUni) {
                    $keys = array_keys(array_column($valores1, 'id'), $valUni);
                    foreach ($keys as $key) {
                        $values1[] = $valores1[$key]["val"];
                    }
                    $valoresZ[] = ['id' => $valUni, 'valor' => array_sum($values1)];
                    unset($values1);
                }

                foreach ($rubros as $rub) {
                    $validate = in_array($rub->id, $valores3);
                    if ($validate == true) {
                        $data = array_keys(array_column($valoresZ, 'id'), $rub->id);
                        $x[] = $valoresZ[$data[0]];
                        $valP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                        unset($x);
                    } else {
                        $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
                    }
                }
            }else {
                foreach ($rubros as $rub) {
                    $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }

            //ADICION
            foreach ($rubros as $R2){
                $ad = RubrosMov::where([['rubro_id', $R2->id],['movimiento', '=', '2']])->get();
                if ($ad->count() > 0){
                    $valoresAdd[] = collect(['id' => $R2->id, 'valor' => $ad->sum('valor')]) ;
                } else{
                    $valoresAdd[] = collect(['id' => $R2->id, 'valor' => 0]) ;
                }
            }


            //REDUCCIÓN
            foreach ($rubros as $R3){
                $red = RubrosMov::where([['rubro_id', $R3->id],['movimiento', '=', '3']])->get();
                if ($red->count() > 0){
                    $valoresRed[] = collect(['id' => $R3->id, 'valor' => $red->sum('valor')]) ;
                } else{
                    $valoresRed[] = collect(['id' => $R3->id, 'valor' => 0]) ;
                }
            }


            //CREDITO
            foreach ($rubros as $R4){
                $cred = RubrosMov::where([['rubro_id', $R4->id],['movimiento', '=', '1']])->get();
                if ($cred->count() > 0){
                    $valoresCred[] = collect(['id' => $R4->id, 'valor' => $cred->sum('valor')]) ;
                }else{
                    $valoresCred[] = collect(['id' => $R4->id, 'valor' => 0]) ;
                }
            }

            //CONTRACREDITO
            foreach ($rubros as $R5){
                foreach ($R5->fontsRubro as $FR){
                    foreach ($FR->rubrosMov as $movR) {
                        if ($movR->movimiento == 1){
                            $suma[] = $movR->valor;
                        }
                    }
                }
                if (isset($suma)){
                    $valoresCcred[] = collect(['id' => $R5->id, 'valor' => array_sum($suma)]);
                    unset($suma);
                } else{
                    $valoresCcred[] = collect(['id' => $R5->id, 'valor' => 0]);
                }
            }

            //CREDITO Y CONTRACREDITO

            for ($i=0;$i<sizeof($valoresCcred);$i++){
                if ($valoresCcred[$i]['id'] == $valoresCred[$i]['id']){
                    $valoresCyC[] = collect(['id' => $valoresCcred[$i]['id'], 'valorC' => $valoresCred[$i]['valor'], 'valorCC' => $valoresCcred[$i]['valor']]) ;
                }
            }

            //PRESUPUESTO DEFINITIVO

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                            foreach ($valoresAdd as $valAdd) {
                                if ($rubrosReg->id == $valAdd["id"]) {
                                    $valAdicion = $valAdd["valor"];
                                }
                            }
                            foreach ($valoresRed as $valRed) {
                                if ($rubrosReg->id == $valRed["id"]) {
                                    $valReduccion = $valRed["valor"];
                                }
                            }
                            foreach ($valoresCred as $valCred) {
                                if ($rubrosReg->id == $valCred["id"]) {
                                    $valCredito = $valCred["valor"];
                                }
                            }
                            foreach ($valoresCcred as $valCcred) {
                                if ($rubrosReg->id == $valCcred["id"]) {
                                    $valCcredito = $valCcred["valor"];
                                }
                            }
                            if (isset($valAdicion) and isset($valReduccion)) {
                                $ArraytotalFR[] = $valFuent + $valAdicion - $valReduccion + $valCredito - $valCcredito;
                            } else {
                                $ArraytotalFR[] = $valFuent + $valCredito - $valCcredito;
                            }

                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresDisp); $i++) {
                            if ($valoresDisp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresDisp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            foreach ($codigos as $cod){
                if ($cod['valor']){
                    foreach ($valoresAdd as $valores1){
                        if ($cod['id_rubro'] == $valores1['id']){
                            $valAd1 = $valores1['valor'];
                        }
                    }
                    foreach ($valoresRed as $valores2){
                        if ($cod['id_rubro'] == $valores2['id']){
                            $valRed1 = $valores2['valor'];
                        }
                    }
                    foreach ($valoresCred as $valores3){
                        if ($cod['id_rubro'] == $valores3['id']){
                            $valCred1 = $valores3['valor'];
                        }
                    }
                    foreach ($valoresCcred as $valores4){
                        if ($cod['id_rubro'] == $valores4['id']){
                            $valCcred1 = $valores4['valor'];
                        }
                    }
                    if (isset($valAd1) and isset($valRed1)){
                        $AD = $cod['valor'] + $valAd1 - $valRed1 + $valCred1 - $valCcred1;
                    } else{
                        $AD = $cod['valor'] + $valCred1 - $valCcred1;
                    }
                    $ArrayDispon[] = collect(['id' => $cod['id_rubro'], 'valor' => $AD]);
                }
            }

            //SALDO DISPONIBLE

            foreach ($ArrayDispon as $valDisp){
                foreach ($valoresCdp as $valCdp){
                    if ($valCdp['id'] == $valDisp['id']){
                        $valrest = $valCdp['valor'];
                    }
                }
                $saldoDisp[] = collect(['id' => $valDisp['id'], 'valor' => $valDisp['valor'] - $valrest]);
            }

            //ROL

            $roles = auth()->user()->roles;
            foreach ($roles as $role){
                $rol= $role->id;
            }

            //CUENTAS POR PAGAR

            for ($i=0;$i<sizeof($valOP);$i++){
                $valueTot = $valOP[$i]['valor'] - $valP[$i]['valor'];
                $valCP[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valueTot]);
                unset($valueTot);
            }

            //RESERVAS

            for ($i=0;$i<sizeof($valoresRubro);$i++){
                $valTot = $valoresRubro[$i]['valor'] - $valOP[$i]['valor'];
                $valR[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valTot]);
                unset($valTot);
            }

            //CODE CONTRACTUALES

            $codeCon = CodeContractuales::all();


            return view('hacienda.presupuesto.newIndexIngresos', compact('codigos','V','fuentes','FRubros','fuentesRubros','valoresIniciales', 'Rubros','valoresCdp','valorDisp','valoresAdd','valoresRed','valoresDisp','ArrayDispon', 'saldoDisp','rol','valoresCred', 'valoresCcred','valoresCyC','ordenPagos','valoresRubro','valorDcdp','valOP','pagos','valP','valCP','valR','codeCon','añoActual','mesActual'));
        }
    }

    public function newPre($id, $year){
        $vigencia = Vigencia::where('tipo',$id)->where('vigencia', $year)->get();
        if ($vigencia->count() == 0){
            return view('hacienda.presupuesto.vigencia.createVigAdelantada',compact('id','year'));
        } else {
            $vigens = Vigencia::findOrFail($vigencia[0]->id);
            $añoActual = $vigens->vigencia;
            $mesActual = Carbon::now()->month;

            $V = $vigens->id;
            $vigencia_id = $V;
            $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
            $registers = Register::where('level_id', $ultimoLevel->id)->get();
            $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
            $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
            $fonts = FontsVigencia::where('vigencia_id',$vigencia_id)->get();
            $rubros = Rubro::where('vigencia_id', $vigencia_id)->get();
            $fontsRubros = FontsRubro::orderBy('font_vigencia_id')->get();
            $allRegisters = Register::orderByDesc('level_id')->get();
            $pagos = Pagos::all();
            $ordenPagos = OrdenPagos::all();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;
            $lastLevel2 = $ultimoLevel2->level_id;

            foreach ($fonts as $font){
                $fuentes[] = collect(['id' => $font->font->id, 'name' => $font->font->name, 'code' => $font->font->code]);
            }

            foreach ($fontsRubros as $fontsRubro){
                if ($fontsRubro->fontVigencia->vigencia_id == $vigencia_id){
                    $fuentesRubros[] = collect(['valor' => $fontsRubro->valor, 'rubro_id' => $fontsRubro->rubro_id, 'font_vigencia_id' => $fontsRubro->font_vigencia_id]);
                }
            }
            $tamFountsRubros = count($fuentesRubros);

            foreach ($registers2 as $register2) {
                if ($register2->level->vigencia_id == $vigencia_id) {
                    global $codigoLast;
                    if ($register2->register_id == null) {
                        $codigoEnd = $register2->code;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    } elseif ($codigoLast > 0) {
                        if ($lastLevel2 == $register2->level_id) {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
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
                                    $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                                    if ($register->level_id == $lastLevel) {
                                        foreach ($rubros as $rubro) {
                                            if ($register->id == $rubro->register_id) {
                                                $newCod = "$code$rubro->cod";
                                                $fR = $rubro->FontsRubro;
                                                //dd($newCod, $fR);
                                                for ($i = 0; $i < $tamFountsRubros; $i++) {
                                                    $rubrosF = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->orderBy('font_vigencia_id')->get();
                                                    $numR = count($rubrosF);
                                                    $numF = count($fonts);
                                                    if ($numR == $numF) {
                                                        if ($fuentesRubros[$i]['rubro_id'] == $rubro->id) {
                                                            $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $fuentesRubros[$i]['font_vigencia_id']]);
                                                        }
                                                    } else {
                                                        foreach ($fonts as $font) {
                                                            if ($fuentesRubros[$i]['font_vigencia_id'] == $font->id) {
                                                                $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'font_vigencia_id' => $font->id]);
                                                            } else {
                                                                $findFont = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->where('font_vigencia_id', $font->id)->get();
                                                                $numFinds = count($findFont);
                                                                if ($numFinds >= 1) {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id + 1;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                } else {

                                                                    $saveRubroF = new FontsRubro();

                                                                    $saveRubroF->valor = 0;
                                                                    $saveRubroF->valor_disp = 0;
                                                                    $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                    $saveRubroF->font_vigencia_id = $font->id;

                                                                    $saveRubroF->save();

                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                $valFuent = FontsRubro::where('rubro_id', $rubro->id)->sum('valor');
                                                $codigos[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id]);
                                                $valDisp = FontsRubro::where('rubro_id', $rubro->id)->sum('valor_disp');
                                                $Rubros[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'name' => $rubro->name, 'code' => $rubro->code, 'V' => $V, 'valor' => $valFuent, 'register_id' => $register->register_id, 'valor_disp' => $valDisp]);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $codigo = $register2->code;
                            $codigoEnd = "$codigoLast$codigo";
                            $codigoLast = $codigoEnd;
                            $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                        }
                    } else {
                        $codigo = $register2->code;
                        $newRegisters = Register::findOrFail($register2->register_id);
                        $codigoNew = $newRegisters->code;
                        $codigoEnd = "$codigoNew$codigo";
                        $codigoLast = $codigoEnd;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '', 'id_rubro' => '', 'register_id' => $register2->register_id]);
                    }
                }
            }

            //VALOR DEL PRESUPUESTO INICIAL

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresIniciales); $i++) {
                            if ($valoresIniciales[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresIniciales[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LAS ADICIONES

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valAdd = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"2")->sum('valor');
                            $ArraytotalAdd[] = $valAdd;
                        }
                        if (isset($ArraytotalAdd)) {
                            $totalAdd = array_sum($ArraytotalAdd);
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => $totalAdd, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalAdd);
                        } else {
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinAdd); $i++) {
                            if ($valoresFinAdd[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinAdd[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinAdd[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LAS REDUCCIONES

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valRed = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"3")->sum('valor');
                            $ArraytotalRed[] = $valRed;
                        }
                        if (isset($ArraytotalRed)) {
                            $totalRed = array_sum($ArraytotalRed);
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => $totalRed, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalRed);
                        } else {
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinRed); $i++) {
                            if ($valoresFinRed[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinRed[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinRed[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            // VALOR TOTAL DE LOS CREDITOS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valCred = RubrosMov::where('rubro_id', $rubrosReg->id)->where('movimiento',"1")->sum('valor');
                            $ArraytotalCred[] = $valCred;
                        }
                        if (isset($ArraytotalCred)) {
                            $totalCred = array_sum($ArraytotalCred);
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => $totalCred, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCred);
                        } else {
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCred); $i++) {
                            if ($valoresFinCred[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCred[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            // VALOR TOTAL DE LOS CONTRACREDITOS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            foreach ($rubrosReg->fontsRubro as $FR){
                                foreach ($FR->rubrosMov as $movR){
                                    if ($movR->movimiento == 1){
                                        $ArraytotalCCred[] = $movR->valor;
                                    }
                                }
                            }
                        }
                        if (isset($ArraytotalCCred)) {
                            $totalCCred = array_sum($ArraytotalCCred);
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => $totalCCred, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCCred);
                        } else {
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCCred); $i++) {
                            if ($valoresFinCCred[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCCred[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCCred[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE CDPS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            foreach ($rubrosReg->rubrosCdp as $Rcdp){
                                $cdpInfo = Cdp::where('id', $Rcdp->cdps->id)->where('jefe_e', '!=', 3)->get();
                                if ($cdpInfo->count() > 0 ){
                                    $ArraytotalCdp[] = $Rcdp->cdps->valor;
                                }
                            }
                        }
                        if (isset($ArraytotalCdp)) {
                            $totalCdp = array_sum($ArraytotalCdp);
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => $totalCdp, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalCdp);
                        } else {
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinCdp); $i++) {
                            if ($valoresFinCdp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinCdp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinCdp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //VALOR TOTAL DE LOS REGISTROS

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosFReg = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosFReg as $rubro) {
                            if ($rubro->cdpRegistroValor->count() == 0){
                                $ArraytotalReg[] =  0 ;
                            }elseif ($rubro->cdpRegistroValor->count() > 1){
                                $ArraytotalReg[] = $rubro->cdpRegistroValor->sum('valor');
                            }else{
                                $reg = $rubro->cdpRegistroValor->first();
                                $ArraytotalReg[] = $reg['valor'];
                            }
                        }
                        if (isset($ArraytotalReg)) {
                            $totalReg = array_sum($ArraytotalReg);
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => $totalReg, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalReg);
                        } else {
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valoresFinReg); $i++) {
                            if ($valoresFinReg[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valoresFinReg[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valoresFinReg[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }

            //SUMA DE VALOR DISPONIBLE DEL RUBRO - CDP

            foreach ($allRegisters as $allRegister){
                if ($allRegister->level->vigencia_id == $vigencia_id) {
                    if ($allRegister->level_id == $lastLevel) {
                        $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                        foreach ($rubrosRegs as $rubrosReg) {
                            $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor_disp');
                            $ArraytotalFR[] = $valFuent;
                        }
                        if (isset($ArraytotalFR)) {
                            $totalFR = array_sum($ArraytotalFR);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($ArraytotalFR);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    } else {
                        for ($i = 0; $i < sizeof($valorDisp); $i++) {
                            if ($valorDisp[$i]['register_id'] == $allRegister->id) {
                                $suma[] = $valorDisp[$i]['valor'];
                            }
                        }
                        if (isset($suma)) {
                            $valSum = array_sum($suma);
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                            unset($suma);
                        } else {
                            $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        }
                    }
                }
            }
        }

        //VALOR DE LOS CDPS DEL RUBRO
        foreach ($rubros as $R){
            if ($R->rubrosCdp->count() == 0){
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0 ]) ;
            }
            if ($R->rubrosCdp->count() > 1){
                foreach ($R->rubrosCdp as $R3){
                    if ($R3->cdps->jefe_e == "2"){
                        $suma2[] = 0;
                    } else{
                        $suma2[] = $R3->rubrosCdpValor->sum('valor');
                    }
                }
                $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => array_sum($suma2)]) ;
                unset($suma2);
            }else{
                foreach ($R->rubrosCdp as $R2){
                    if ($R2->cdps->jefe_e == "2"){
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => 0]) ;
                    }else {
                        $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => $R2->rubrosCdpValor->sum('valor')]) ;
                    }
                }
            }

        }

        //VALOR DE LOS REGISTROS DEL RUBRO
        foreach ($rubros as $rub){
            if ($rub->cdpRegistroValor->count() == 0){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => 0 ]) ;
            }elseif ($rub->cdpRegistroValor->count() > 1){
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $rub->cdpRegistroValor->sum('valor')]);
            }else{
                $reg = $rub->cdpRegistroValor->first();
                $valoresRubro[] = collect(['id' => $rub->id, 'name' => $rub->name, 'valor' => $reg['valor']]) ;
            }
        }

        //VALORES TOTALES SALDO CDP

        for ($i=0;$i<count($valoresFinCdp);$i++){
            $valorFcdp[] = collect(['id' => $valoresFinCdp[$i]['id'], 'valor' => $valoresFinCdp[$i]['valor'] - $valoresFinReg[$i]['valor']]);
        }


        //VALOR DISPONIBLE CDP - REGISTROS
        for ($i=0;$i<count($valoresCdp);$i++){
            $valorDcdp[] = collect(['id' => $valoresCdp[$i]['id'], 'valor' => $valoresCdp[$i]['valor'] - $valoresRubro[$i]['valor']]);
        }


        //ORDEN DE PAGO

        $OP = OrdenPagosRubros::all();
        if ($OP->count() != 0){
            foreach ($OP as $val){
                $valores[] = ['id' => $val->cdps_registro->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores as $id){
                $ids[] = $id['id'];
            }
            $valores2 = array_unique($ids);
            foreach ($valores2 as $valUni){
                $keys = array_keys(array_column($valores, 'id'), $valUni);
                foreach ($keys as $key){
                    $values[] = $valores[$key]["val"];
                }
                $valoresF[] = ['id' => $valUni, 'valor' => array_sum($values)];
                unset($values);
            }
            foreach ($rubros as $rub){
                $validate = in_array($rub->id, $valores2);
                if ($validate == true ){
                    $data = array_keys(array_column($valoresF, 'id'), $rub->id);
                    $x[] = $valoresF[$data[0]];
                    $valOP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        } else {
            foreach ($rubros as $rub){
                $valOP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //TOTALES ORDEN DE PAGO

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubs as $rubro) {
                        foreach ($valOP as $data){
                            if ($data['id'] == $rubro->id and $data['valor'] != 0){
                                $ArrayTotalOp[] = $data['valor'];
                            }
                        }
                    }
                    if (isset($ArrayTotalOp)) {
                        $totalOp = array_sum($ArrayTotalOp);
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => $totalOp, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArrayTotalOp);
                    } else {
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresFinOp); $i++) {
                        if ($valoresFinOp[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresFinOp[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresFinOp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }

        //PAGOS

        $pagos2 = PagoRubros::all();
        if ($pagos2->count() != 0) {

            foreach ($pagos2 as $val) {
                $valores1[] = ['id' => $val->rubro->id, 'val' => $val->valor];
            }
            foreach ($valores1 as $id1) {
                $ides[] = $id1['id'];
            }
            $valores3 = array_unique($ides);
            foreach ($valores3 as $valUni) {
                $keys = array_keys(array_column($valores1, 'id'), $valUni);
                foreach ($keys as $key) {
                    $values1[] = $valores1[$key]["val"];
                }
                $valoresZ[] = ['id' => $valUni, 'valor' => array_sum($values1)];
                unset($values1);
            }

            foreach ($rubros as $rub) {
                $validate = in_array($rub->id, $valores3);
                if ($validate == true) {
                    $data = array_keys(array_column($valoresZ, 'id'), $rub->id);
                    $x[] = $valoresZ[$data[0]];
                    $valP[] = collect(['id' => $rub->id, 'valor' => $x[0]['valor']]);
                    unset($x);
                } else {
                    $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
                }
            }
        }else {
            foreach ($rubros as $rub) {
                $valP[] = collect(['id' => $rub->id, 'valor' => 0]);
            }
        }

        //TOTALES PAGOS

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubs as $rubro) {
                        foreach ($valP as $data){
                            if ($data['id'] == $rubro->id and $data['valor'] != 0){
                                $ArrayTotalP[] = $data['valor'];
                            }
                        }
                    }
                    if (isset($ArrayTotalP)) {
                        $totalP = array_sum($ArrayTotalP);
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => $totalP, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArrayTotalP);
                    } else {
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresFinP); $i++) {
                        if ($valoresFinP[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresFinP[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresFinP[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }

        //ADICION
        foreach ($rubros as $R2){
            $ad = RubrosMov::where([['rubro_id', $R2->id],['movimiento', '=', '2']])->get();
            if ($ad->count() > 0){
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => $ad->sum('valor')]) ;
            } else{
                $valoresAdd[] = collect(['id' => $R2->id, 'valor' => 0]) ;
            }
        }


        //REDUCCIÓN
        foreach ($rubros as $R3){
            $red = RubrosMov::where([['rubro_id', $R3->id],['movimiento', '=', '3']])->get();
            if ($red->count() > 0){
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => $red->sum('valor')]) ;
            } else{
                $valoresRed[] = collect(['id' => $R3->id, 'valor' => 0]) ;
            }
        }


        //CREDITO
        foreach ($rubros as $R4){
            $cred = RubrosMov::where([['rubro_id', $R4->id],['movimiento', '=', '1']])->get();
            if ($cred->count() > 0){
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => $cred->sum('valor')]) ;
            }else{
                $valoresCred[] = collect(['id' => $R4->id, 'valor' => 0]) ;
            }
        }

        //CONTRACREDITO
        foreach ($rubros as $R5){
            foreach ($R5->fontsRubro as $FR){
                foreach ($FR->rubrosMov as $movR) {
                    if ($movR->movimiento == 1){
                        $suma[] = $movR->valor;
                    }
                }
            }
            if (isset($suma)){
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => array_sum($suma)]);
                unset($suma);
            } else{
                $valoresCcred[] = collect(['id' => $R5->id, 'valor' => 0]);
            }
        }

        //CREDITO Y CONTRACREDITO

        for ($i=0;$i<sizeof($valoresCcred);$i++){
            if ($valoresCcred[$i]['id'] == $valoresCred[$i]['id']){
                $valoresCyC[] = collect(['id' => $valoresCcred[$i]['id'], 'valorC' => $valoresCred[$i]['valor'], 'valorCC' => $valoresCcred[$i]['valor']]) ;
            }
        }

        //PRESUPUESTO DEFINITIVO

        foreach ($allRegisters as $allRegister){
            if ($allRegister->level->vigencia_id == $vigencia_id) {
                if ($allRegister->level_id == $lastLevel) {
                    $rubrosRegs = Rubro::where('register_id', $allRegister->id)->get();
                    foreach ($rubrosRegs as $rubrosReg) {
                        $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                        foreach ($valoresAdd as $valAdd) {
                            if ($rubrosReg->id == $valAdd["id"]) {
                                $valAdicion = $valAdd["valor"];
                            }
                        }
                        foreach ($valoresRed as $valRed) {
                            if ($rubrosReg->id == $valRed["id"]) {
                                $valReduccion = $valRed["valor"];
                            }
                        }
                        foreach ($valoresCred as $valCred) {
                            if ($rubrosReg->id == $valCred["id"]) {
                                $valCredito = $valCred["valor"];
                            }
                        }
                        foreach ($valoresCcred as $valCcred) {
                            if ($rubrosReg->id == $valCcred["id"]) {
                                $valCcredito = $valCcred["valor"];
                            }
                        }
                        if (isset($valAdicion) and isset($valReduccion)) {
                            $ArraytotalFR[] = $valFuent + $valAdicion - $valReduccion + $valCredito - $valCcredito;
                        } else {
                            $ArraytotalFR[] = $valFuent + $valCredito - $valCcredito;
                        }

                    }
                    if (isset($ArraytotalFR)) {
                        $totalFR = array_sum($ArraytotalFR);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArraytotalFR);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else {
                    for ($i = 0; $i < sizeof($valoresDisp); $i++) {
                        if ($valoresDisp[$i]['register_id'] == $allRegister->id) {
                            $suma[] = $valoresDisp[$i]['valor'];
                        }
                    }
                    if (isset($suma)) {
                        $valSum = array_sum($suma);
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    } else {
                        $valoresDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }
        }


        foreach ($codigos as $cod){
            if ($cod['valor']){
                foreach ($valoresAdd as $valores1){
                    if ($cod['id_rubro'] == $valores1['id']){
                        $valAd1 = $valores1['valor'];
                    }
                }
                foreach ($valoresRed as $valores2){
                    if ($cod['id_rubro'] == $valores2['id']){
                        $valRed1 = $valores2['valor'];
                    }
                }
                foreach ($valoresCred as $valores3){
                    if ($cod['id_rubro'] == $valores3['id']){
                        $valCred1 = $valores3['valor'];
                    }
                }
                foreach ($valoresCcred as $valores4){
                    if ($cod['id_rubro'] == $valores4['id']){
                        $valCcred1 = $valores4['valor'];
                    }
                }
                if (isset($valAd1) and isset($valRed1)){
                    $AD = $cod['valor'] + $valAd1 - $valRed1 + $valCred1 - $valCcred1;
                } else{
                    $AD = $cod['valor'] + $valCred1 - $valCcred1;
                }
                $ArrayDispon[] = collect(['id' => $cod['id_rubro'], 'valor' => $AD]);
            }
        }

        //SALDO DISPONIBLE

        foreach ($ArrayDispon as $valDisp){
            foreach ($valoresCdp as $valCdp){
                if ($valCdp['id'] == $valDisp['id']){
                    $valrest = $valCdp['valor'];
                }
            }
            $saldoDisp[] = collect(['id' => $valDisp['id'], 'valor' => $valDisp['valor'] - $valrest]);
        }

        //ROL

        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }

        //CUENTAS POR PAGAR

        for ($i=0;$i<sizeof($valOP);$i++){
            $valueTot = $valOP[$i]['valor'] - $valP[$i]['valor'];
            $valCP[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valueTot]);
            unset($valueTot);
        }

        //TOTAL CUENTAS POR PAGAR

        for ($i=0;$i<sizeof($valoresFinOp);$i++){
            $valTot = $valoresFinOp[$i]['valor'] - $valoresFinP[$i]['valor'];
            $valoresFinC[] = collect(['id' => $valoresFinOp[$i]['id'], 'valor' => $valTot]);
            unset($valTot);
        }

        //RESERVAS

        for ($i=0;$i<sizeof($valoresRubro);$i++){
            $valTot = $valoresRubro[$i]['valor'] - $valOP[$i]['valor'];
            $valR[] = collect(['id' => $valOP[$i]['id'], 'valor' => $valTot]);
            unset($valTot);
        }

        //TOTAL RESERVAS

        for ($i=0;$i<sizeof($valoresFinReg);$i++){
            $totally = $valoresFinReg[$i]['valor'] - $valoresFinOp[$i]['valor'];
            $valoresFinRes[] = collect(['id' => $valoresFinOp[$i]['id'], 'valor' => $totally]);
            unset($totally);
        }

        //CODE CONTRACTUALES

        $codeCon = CodeContractuales::all();

        //CDP's

        $cdps= Cdp::where('vigencia_id', $V)->get();

        //REGISTROS
        $registros = Registro::all();

        return view('hacienda.presupuesto.newIndex', compact('codigos','V','fuentes','FRubros','fuentesRubros','valoresIniciales','cdps', 'Rubros','valoresCdp','registros','valorDisp','valoresAdd','valoresRed','valoresDisp','ArrayDispon', 'saldoDisp','rol','valoresCred', 'valoresCcred','valoresCyC','ordenPagos','valoresRubro','valorDcdp','valOP','pagos','valP','valCP','valR','codeCon','añoActual','valoresFinAdd','valoresFinRed','valoresFinCred','valoresFinCCred','valoresFinCdp','valoresFinReg','valorFcdp','valoresFinOp','valoresFinP','valoresFinC','valoresFinRes','mesActual'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}