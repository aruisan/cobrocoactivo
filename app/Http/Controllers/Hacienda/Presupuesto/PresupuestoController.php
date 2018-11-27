<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Admin\Dependencia;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Administrativo\Registro\Registro;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $vigens = Vigencia::where('vigencia', 2018)->where('tipo', 1)->get();
        //dd($vigens);
        //$vigens = null;
        $vigens = Vigencia::where('id', '>',0)->get();
        $count = count($vigens);

        if ($count < 1){
            $V = "Vacio";
            return view('hacienda.presupuesto.index', compact('V'));
        } else {
            foreach ($vigens as $vigen) {
                $V = $vigen->id;
            }

            $cdps= Cdp::all();
            $vigencia_id = $V;
            $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
            $registers = Register::where('level_id', $ultimoLevel->id)->get();
            $registers2 = Register::where('level_id', '<', $ultimoLevel->id)->get();
            $ultimoLevel2 = Register::where('level_id', '<', $ultimoLevel->id)->get()->last();
            $fonts = Font::where('vigencia_id',$vigencia_id)->get();
            $rubros = Rubro::where('vigencia_id', $vigencia_id)->get();
            $fontsRubros = FontsRubro::orderBy('font_id')->get();
            $allRegisters = Register::orderByDesc('level_id')->get();

            global $lastLevel;
            $lastLevel = $ultimoLevel->id;
            $lastLevel2 = $ultimoLevel2->level_id;

            foreach ($fonts as $font){
                $fuentes[] = collect(['id' => $font->id, 'name' => $font->name, 'code' => $font->code]);
            }
            foreach ($fontsRubros as $fontsRubro){
                $fuentesRubros[] = collect(['valor' => $fontsRubro->valor, 'rubro_id' => $fontsRubro->rubro_id, 'fount_id' => $fontsRubro->font_id,'id_rubro' => '']);
            }
            $tamFountsRubros = count($fuentesRubros);

            foreach ($registers2 as $register2) {
                global $codigoLast;
                if ($register2->register_id == null) {
                    $codigoEnd = $register2->code;
                    $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '','id_rubro' => '', 'register_id' => $register2->register_id]);
                } elseif ($codigoLast > 0) {
                    if ($lastLevel2 == $register2->level_id) {
                        $codigo = $register2->code;
                        $codigoEnd = "$codigoLast$codigo";
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '','id_rubro' => '', 'register_id' => $register2->register_id]);
                        foreach ($registers as $register) {
                            if($register2->id == $register->register_id){
                                $register_id = $register->code_padre->registers->id;
                                $code = $register->code_padre->registers->code . $register->code;
                                $ultimo = $register->code_padre->registers->level->level;

                                while ($ultimo > 1) {
                                    $registro = Register::findOrFail($register_id);
                                    $register_id = $registro->code_padre->registers->id;
                                    $code = $registro->code_padre->registers->code . $code;

                                    $ultimo = $registro->code_padre->registers->level->level;
                                }
                                $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'code' => '', 'V' => $V, 'valor' => '','id_rubro' => '','register_id' => $register2->register_id]);
                                if ($register->level_id == $lastLevel){
                                    foreach ($rubros as $rubro) {
                                        if ($register->id == $rubro->register_id) {
                                            $newCod = "$code$rubro->cod";
                                            $fR = $rubro->FontsRubro;
                                            //dd($newCod, $fR);
                                            for ($i=0;$i<$tamFountsRubros;$i++){
                                                $rubrosF = FontsRubro::where('rubro_id', $fuentesRubros[$i]['rubro_id'])->orderBy('font_id')->get();
                                                $numR = count($rubrosF);
                                                $numF = count($fonts);
                                                if ($numR == $numF){
                                                    if ($fuentesRubros[$i]['rubro_id'] == $rubro->id){
                                                        $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $fuentesRubros[$i]['fount_id']]);
                                                    }
                                                }else{
                                                    foreach ($fonts as $font){
                                                        if ($fuentesRubros[$i]['fount_id'] == $font->id){
                                                            $FRubros[] = collect(['valor' => $fuentesRubros[$i]['valor'], 'rubro_id' => $fuentesRubros[$i]['rubro_id'], 'fount_id' => $font->id]);
                                                        }else{
                                                            $findFont = FontsRubro::where('rubro_id',$fuentesRubros[$i]['rubro_id'])->where('font_id',$font->id)->get();
                                                            $numFinds = count($findFont);
                                                            if ($numFinds >= 1){

                                                                $saveRubroF = new FontsRubro();

                                                                $saveRubroF->valor = 0;
                                                                $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                $saveRubroF->font_id = $font->id+1;

                                                                $saveRubroF->save();

                                                                break;
                                                            }else{

                                                                $saveRubroF = new FontsRubro();

                                                                $saveRubroF->valor = 0;
                                                                $saveRubroF->rubro_id = $fuentesRubros[$i]['rubro_id'];
                                                                $saveRubroF->font_id = $font->id;

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
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '','id_rubro' => '', 'register_id' => $register2->register_id]);
                    }
                } else {
                    $codigo = $register2->code;
                    $newRegisters = Register::findOrFail($register2->register_id);
                    $codigoNew = $newRegisters->code;
                    $codigoEnd = "$codigoNew$codigo";
                    $codigoLast = $codigoEnd;
                    $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'code' => '', 'V' => $V, 'valor' => '','id_rubro' => '', 'register_id' => $register2->register_id]);
                }
            }
            //Sumas de los Valores
            foreach ($allRegisters as $allRegister){
                if($allRegister->level_id == $lastLevel){
                    $rubrosRegs = Rubro::where('register_id',$allRegister->id)->get();
                    foreach ($rubrosRegs as $rubrosReg){
                        $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor');
                        $ArraytotalFR[] = $valFuent;
                    }
                    if (isset($ArraytotalFR)){
                        $totalFR = array_sum($ArraytotalFR);
                        $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArraytotalFR);
                    }else{
                        $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else{
                    for ($i=0;$i<sizeof($valoresIniciales);$i++){
                        if ($valoresIniciales[$i]['register_id'] == $allRegister->id){
                            $suma[] = $valoresIniciales[$i]['valor'];
                        }
                    }
                    if (isset($suma)){
                        $valSum = array_sum($suma);
                        $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    }else{
                        $valoresIniciales[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }

            //SUMA DE VALOR DISPONIBLE DEL RUBRO - CDP

            foreach ($allRegisters as $allRegister){
                if($allRegister->level_id == $lastLevel){
                    $rubrosRegs = Rubro::where('register_id',$allRegister->id)->get();
                    foreach ($rubrosRegs as $rubrosReg){
                        $valFuent = FontsRubro::where('rubro_id', $rubrosReg->id)->sum('valor_disp');
                        $ArraytotalFR[] = $valFuent;
                    }
                    if (isset($ArraytotalFR)){
                        $totalFR = array_sum($ArraytotalFR);
                        $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $totalFR, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($ArraytotalFR);
                    }else{
                        $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                } else{
                    for ($i=0;$i<sizeof($valorDisp);$i++){
                        if ($valorDisp[$i]['register_id'] == $allRegister->id){
                            $suma[] = $valorDisp[$i]['valor'];
                        }
                    }
                    if (isset($suma)){
                        $valSum = array_sum($suma);
                        $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => $valSum, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                        unset($suma);
                    }else{
                        $valorDisp[] = collect(['id' => $allRegister->id, 'valor' => 0, 'level_id' => $allRegister->level_id, 'register_id' => $allRegister->register_id]);
                    }
                }
            }

        }
        //VALOR DE LOS CDPS DEL RUBRO
        foreach ($rubros as $R){
            $valoresCdp[] = collect(['id' => $R->id, 'name' => $R->name, 'valor' => $R->fontsRubro->sum('valor') - $R->fontsRubro->sum('valor_disp')]) ;
        }
        //REGISTROS
        $registros = Registro::all();

        return view('hacienda.presupuesto.index', compact('codigos','V','fuentes','FRubros','fuentesRubros','valoresIniciales','cdps', 'Rubros','valoresCdp','registros','valorDisp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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