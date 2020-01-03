<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\FontsVigencia;
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
        $levels = FontsVigencia::where('vigencia_id', $vigencia_id)->count();
        $fonts = FontsVigencia::where('vigencia_id', $vigencia_id)->get();

        if($levels == 0){
            $fila = $vigencia->ultimo;
        }else if($levels >= $vigencia->ultimo){
            $fila = 0;
        }else if( $vigencia->ultimo > $levels){
            $fila = $vigencia->ultimo - $levels;
        }

        return view('hacienda.presupuesto.vigencia.createFonts', compact('vigencia', 'fila', 'niveles','fonts'));
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
                $font->save();

                $fontVig = new FontsVigencia();
                $fontVig->valor = $valor[$i];
                $fontVig->vigencia_id = $vigencia;
                $fontVig->font_id = $font->id;
                $fontVig->save();
            }
        }

        return  back();
    }


    public function show($id)
    {
        $data = FontsVigencia::where('vigencia_id', $id)->get();

        return $data;
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



    public function update($id, $name, $valor, $code)
    {
        //dd($name);
        $font = FontsVigencia::findOrFail($id);
        $font->valor = $valor;
        $font->save();
    }



    public function destroy($id)
    {
        $font = FontsVigencia::find($id);
        if($font->fontsRubro->sum('valor')){
            Session::flash('warning', 'Esta usando dinero de esa fuente en rubros.');
        }else{
            $font->delete();
            Session::flash('error','Fuente Eliminada correctamente');
        }
    }
}