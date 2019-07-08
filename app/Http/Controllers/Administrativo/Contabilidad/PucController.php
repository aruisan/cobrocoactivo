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

        if (count($data) >= 1){
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

            return view('administrativo.contabilidad.puc.index', compact('data','codigos'));
        } else {
            return view('administrativo.contabilidad.puc.index', compact('data'));
        }


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
