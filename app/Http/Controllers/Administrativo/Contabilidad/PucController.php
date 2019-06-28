<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\Puc;
use App\Model\Administrativo\Contabilidad\RubrosPuc;
use App\Model\Administrativo\Contabilidad\RegistersPuc;
use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Puc::all()->first();

        $puc_id = $data->id;
        $ultimoLevel = LevelPUC::where('puc_id', $puc_id)->get()->last();
        $registers = RegistersPuc::where('level_puc_id', $ultimoLevel->id)->get();
        $registers2 = RegistersPuc::where('level_puc_id', '<', $ultimoLevel->id)->get();
        $ultimoLevel2 = RegistersPuc::where('level_puc_id', '<', $ultimoLevel->id)->get()->last();
        $rubros = RubrosPuc::where('puc_id', $puc_id)->get();


        $R1 = RegistersPuc::where('register_puc_id','=', NULL)->get();
        $R2 = RegistersPuc::where('register_puc_id','!=', NULL)->get();



        global $lastLevel;
        $lastLevel = $ultimoLevel->id;
        $lastLevel2 = $ultimoLevel2->level_puc_id;

        foreach ($registers2 as $register2) {
            global $codigoLast;
            if ($register2->register_id == null) {
                $codigoEnd = $register2->code;
                $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'lvl' => $register2->level_puc_id, 'register_id' => $register2->register_puc_id]);
            }elseif ($codigoLast > 0) {
                if ($lastLevel2 == $register2->level_puc_id) {
                    $codigo = $register2->code;
                    $codigoEnd = "$codigoLast$codigo";
                    $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'lvl' => $register2->level_puc_id, 'register_id' => $register2->register_puc_id]);
                    foreach ($registers as $register) {
                        if($register2->id == $register->register_puc_id){
                            $register_id = $register->code_padre->registers->id;
                            $code = $register->code_padre->registers->code . $register->code;
                            $ultimo = $register->code_padre->registers->level->level;

                            while ($ultimo > 1) {
                                $registro = RegistersPuc::findOrFail($register_id);
                                $register_id = $registro->code_padre->registers->id;
                                $code = $registro->code_padre->registers->code . $code;

                                $ultimo = $registro->code_padre->registers->level->level;
                            }
                            $codigos[] = collect(['id' => $register->id, 'codigo' => $code, 'name' => $register->name, 'lvl' => $register2->level_puc_id,'register_id' => $register2->register_puc_id]);
                            if ($register->level_puc_id == $lastLevel){
                                foreach ($rubros as $rubro) {
                                    if ($register->id == $rubro->register_puc_id) {
                                        $newCod = "$code$rubro->codigo";
                                        $codigos[] = collect(['id_rubro' => $rubro->id, 'id' => '', 'codigo' => $newCod, 'lvl' => $lastLevel, 'name' => $rubro->nombre_cuenta, 'code' => $rubro->codigo, 'code_N' =>  $rubro->codigo_NIPS, 'name_N' => $rubro->nombre_NIPS, 'naturaleza' => $rubro->naturaleza,'per_id' => $rubro->persona_id, 'register_id' => $register->register_puc_id]);
                                    }
                                }
                            }
                        } else{

                        }
                    }
                } else {
                    $ultimoArray = end($codigos);
                    if ($ultimoArray['lvl'] == $lastLevel){
                        dd($register2);
                        $codigo = $register2->code;
                        $codigoEnd = "$codigoLast$codigo";
                        $codigoLast = $codigoEnd;
                        $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'lvl' => $register2->level_puc_id, 'register_id' => $register2->register_puc_id]);
                    }
                }
            } else {
                $codigo = $register2->code;
                $newRegisters = RegistersPuc::findOrFail($register2->register_puc_id);
                $codigoNew = $newRegisters->code;
                $codigoEnd = "$codigoNew$codigo";
                $codigoLast = $codigoEnd;
                $codigos[] = collect(['id' => $register2->id, 'codigo' => $codigoEnd, 'name' => $register2->name, 'lvl' => $register2->level_puc_id, 'register_id' => $register2->register_puc_id]);
            }
        }

        return view('administrativo.contabilidad.puc.index', compact('data','codigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contabilidad.puc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puc = new Puc();
        $puc->vigencia = $request->vigencia;
        $puc->levels = $request->niveles;
        $puc->save();

        return  redirect('administrativo/contabilidad/puc/level/create/'.$puc->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function show(Puc $puc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function edit(Puc $puc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puc $puc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puc $puc)
    {
        //
    }
}
