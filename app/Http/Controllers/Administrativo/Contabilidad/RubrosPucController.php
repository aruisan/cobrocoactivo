<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\RubrosPuc;
use App\Model\Administrativo\Contabilidad\RegistersPuc;
use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Model\Administrativo\Contabilidad\Puc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class RubrosPucController extends Controller
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
    public function create($vigencia_id)
    {
        $vigencia = Puc::findOrFail($vigencia_id);
        $niveles = LevelPUC::where('puc_id', $vigencia_id)->get();
        $ultimoLevel = LevelPUC::where('puc_id', $vigencia_id)->get()->last();
        $registers = RegistersPuc::where('level_puc_id', $ultimoLevel->id)->get();


        foreach ($registers as $register){
            $register_id = $register->code_padre->registers->id;
            $code = $register->code_padre->registers->code.$register->code;
            $ultimo = $register->code_padre->registers->level->level;
            while($ultimo > 1){
                $registro = RegistersPuc::findOrFail($register_id);
                $register_id = $registro->code_padre->registers->id;
                $code = $registro->code_padre->registers->code.$code;

                $ultimo =  $registro->code_padre->registers->level->level;

            }
            $codigos[] = collect(['id' => $register->id , 'codigo' => $code]);
        }



        $levels = RubrosPuc::where('puc_id', $vigencia_id)->count();
        if($levels == 0){
            $fila = $vigencia->levels;
        }else if($levels >= $vigencia->levels){
            $fila = 0;
        }else if( $vigencia->levels > $levels){
            $fila = $vigencia->levels - $levels;
        }

        return view('administrativo.contabilidad.puc.createRubros', compact('vigencia', 'fila', 'niveles', 'registers', 'codigos','vigencia_id'));
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
     * @param  \App\RubrosPuc  $rubrosPuc
     * @return \Illuminate\Http\Response
     */
    public function show(RubrosPuc $rubrosPuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RubrosPuc  $rubrosPuc
     * @return \Illuminate\Http\Response
     */
    public function edit(RubrosPuc $rubrosPuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RubrosPuc  $rubrosPuc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RubrosPuc $rubrosPuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RubrosPuc  $rubrosPuc
     * @return \Illuminate\Http\Response
     */
    public function destroy(RubrosPuc $rubrosPuc)
    {
        //
    }
}
