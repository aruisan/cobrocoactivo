<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Rubro;
use Session;

class LevelController extends Controller
{
    public function index()
    {
    }

    public function create($vigencia_id)
    {
        $vigencia = Vigencia::findOrFail($vigencia_id);
        $levels = Level::where('vigencia_id', $vigencia_id)->count();
        $niveles = Level::where('vigencia_id', $vigencia_id)->get();

        if($levels == 0){
           $fila = $vigencia->ultimo;
        }else if($levels >= $vigencia->ultimo){
            $fila = 0;
        }else if( $vigencia->ultimo > $levels){
            $fila = $vigencia->ultimo - $levels;
        }
       //dd($vigencia);
        return view('hacienda.presupuesto.vigencia.createniveles', compact('vigencia', 'fila', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        //dd($request->all());
        $id        = $request->level_id;
        $name      = $request->nombre;
        $nivel     = $request->nivel;
        $cifras    = $request->cifra;
        $rows      = $request->fila;
        $vigencia  = $request->vigencia_id;
        $count = count($nivel);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $nivel[$i], $cifras[$i], $rows[$i]);
                
            }else{   
                $conteoRubro = Rubro::where('vigencia_id', $vigencia)->count();
                if ($conteoRubro <> 0) {
                    Session::flash('error','El presupuesto ya tiene rubros creados, no se pueden crear mas niveles');
                    return  back();
                }         
                $level = new Level();
                $level->name = $name[$i];
                $level->level = $nivel[$i];
                $level->cifras = $cifras[$i];
                $level->rows = $rows[$i];
                $level->vigencia_id = $vigencia;
                $level->save();
            }
        }
        Session::flash('success','Los Niveles se han creado exitosamente');
       return  redirect('presupuesto/registro/create/'.$vigencia.'/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Level::where('vigencia_id', $id)->get();

        return $data;


        /*$data = Level::where('vigencia_id', $id)->get();


        return $data;*/
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
    public function update($id, $name, $nivel, $cifras, $rows)
    {
        //dd($name);
        $level = Level::findOrFail($id);
        $level->name = $name;
        $level->level = $nivel;
        $level->cifras = $cifras;
        $level->rows = $rows;
        $level->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Level::find($id);
        $proyecto->delete();
    }
}
