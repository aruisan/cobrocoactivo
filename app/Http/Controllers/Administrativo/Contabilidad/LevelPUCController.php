<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Model\Administrativo\Contabilidad\Puc;
use App\Model\Administrativo\Contabilidad\RubrosPuc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LevelPUCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $puc = Puc::findOrFail($id);
        $levels = LevelPUC::all()->count();
        $niveles = LevelPUC::all();

        if($levels == 0){
            $fila = $puc->levels;
        }else if($levels >= $puc->levels){
            $fila = 0;
        }else if( $puc->levels > $levels){
            $fila = $puc->levels - $levels;
        }
        return view('administrativo.contabilidad.puc.createNiveles', compact('levels','niveles','fila','puc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id        = $request->level_id;
        $name      = $request->nombre;
        $nivel     = $request->nivel;
        $cifras    = $request->cifra;
        $rows      = $request->fila;
        $vigencia  = $request->puc_id;
        $count = count($nivel);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $nivel[$i], $cifras[$i], $rows[$i]);

            }else{
                $conteoRubro = RubrosPuc::where('puc_id', $vigencia)->count();
                if ($conteoRubro <> 0) {
                    Session::flash('error','El PUC ya tiene rubros creados, no se pueden crear mas niveles');
                    return  back();
                }
                $level = new LevelPUC();
                $level->name = $name[$i];
                $level->level = $nivel[$i];
                $level->cifras = $cifras[$i];
                $level->rows = $rows[$i];
                $level->puc_id = $vigencia;
                $level->save();
            }
        }
        Session::flash('success','Los Niveles se han creado exitosamente');
        return  redirect('administrativo/contabilidad/puc/registers/create/'.$vigencia.'/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LevelPUC  $levelPUC
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = LevelPUC::where('puc_id', $id)->get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LevelPUC  $levelPUC
     * @return \Illuminate\Http\Response
     */
    public function edit(LevelPUC $levelPUC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LevelPUC  $levelPUC
     * @return \Illuminate\Http\Response
     */
    public function update($id, $name, $nivel, $cifras, $rows)
    {
        $level = LevelPUC::findOrFail($id);
        $level->name = $name;
        $level->level = $nivel;
        $level->cifras = $cifras;
        $level->rows = $rows;
        $level->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LevelPUC  $levelPUC
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = LevelPUC::findOrFail($id);
        $level->delete();
    }
}
