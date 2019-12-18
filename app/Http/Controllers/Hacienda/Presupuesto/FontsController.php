<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;

use Session;

class FontsController extends Controller
{

    public function create($vigencia_id)
    {
        $vigencia = Vigencia::findOrFail($vigencia_id);
        $niveles = Level::where('vigencia_id', $vigencia_id)->get();
        $levels = Font::where('vigencia_id', $vigencia_id)->count();

        if($levels == 0){
           $fila = $vigencia->ultimo;
        }else if($levels >= $vigencia->ultimo){
            $fila = 0;
        }else if( $vigencia->ultimo > $levels){
            $fila = $vigencia->ultimo - $levels;
        }
        return view('hacienda.presupuesto.vigencia.createFonts', compact('vigencia', 'fila', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id        = $request->font_id;
        $name      = $request->nombre;
        $code      = $request->code;
        $valor     = $request->valor;
        $vigencia  = $request->vigencia_id;
        $count = count($valor);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $valor[$i], $code[$i] );      
            }else{          
                $font = new Font();
                $font->name = $name[$i];
                $font->code = $code[$i];
                $font->valor = $valor[$i];
                $font->vigencia_id = $vigencia;
                $font->save();
            }
        }

       return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Font::where('vigencia_id', $id)->get();

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
    public function update($id, $name, $valor, $code)
    {
        //dd($name);
        $font = Font::findOrFail($id);
        $font->name = $name;
        $font->code = $code;
        $font->valor = $valor;
        $font->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $font = Font::find($id);
        if($font->fontsRubro->sum('valor')){
            Session::flash('warning', 'tiene $'.$font->fontsRubro->sum('valor').' usados en rubros.');
        }else{
            $font->delete();
            Session::flash('error','Fuente Eliminada correctamente');
        }
    }
}
