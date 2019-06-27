<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\RegistersPuc;
use App\Model\Administrativo\Contabilidad\CodePadrePuc;
use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistersPucController extends Controller
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
    public function create($vigencia, $level)
    {
        $nivel = LevelPUC::where('puc_id', $vigencia)->where('level', $level)->first();
        $niveles = LevelPUC::where('puc_id', $vigencia)->get();

        if($nivel->level > 1){
            $level2 = $level-1;
            $nivel2 = LevelPUC::where('puc_id', $vigencia)->where('level', $level2)->first();
            $codes = RegistersPuc::where('level_puc_id', $nivel2->id)->get();

        }else{
            $codes = "";
        }

        $conteo = RegistersPuc::where('level_puc_id', $nivel->id)->count();

        if($conteo == 0){
            $fila = $nivel->rows;
        }else if($conteo >= $nivel->rows){
            $fila = 0;
        }else if( $nivel->rows > $conteo){
            $fila = $nivel->rows - $conteo;
        }

        return view('administrativo.contabilidad.puc.createRegistros', compact('nivel', 'niveles', 'fila', 'codes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->level > 1){
            $padre = $request->padre;
        }else{
            $padre = null;
        }

        $id        = $request->register_id;
        $name      = $request->nombre;
        $code     = $request->code;
        $level_id  = $request->level_id;
        $level  = $request->level;
        $count = count($code);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $code[$i], $padre[$i], $level);
            }else{
                $register = new RegistersPuc();
                $register->name = $name[$i];
                $register->code = $code[$i];
                $register->register_puc_id = $padre[$i];
                $register->level_puc_id = $level_id;
                $register->save();

                if($level > 1){
                    $codePadre = new CodePadrePuc();
                    $codePadre->register_puc_id = $register->id;
                    $codePadre->register2_puc_id = $padre[$i];
                    $codePadre->save();
                }
            }
        }
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistersPuc  $registersPuc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RegistersPuc::where('level_puc_id', $id)->get();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistersPuc  $registersPuc
     * @return \Illuminate\Http\Response
     */
    public function update($id, $name, $code, $padre, $level)
    {
        $register = RegistersPuc::findOrFail($id);
        $register->name = $name;
        $register->code = $code;
        $register->register_puc_id = $padre;
        $register->save();

        if($level > 1){
            $codePadre = CodePadrePuc::where('register_puc_id', $id)->first();
            $codePadre->register2_puc_id = $padre;
            $codePadre->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistersPuc  $registersPuc
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, RegistersPuc $registersPuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistersPuc  $registersPuc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clienteplus = CodePadrePuc::where('register_puc_id', $id)->delete();
        $registro = RegistersPuc::find($id);
        $registro->delete();
    }
}
