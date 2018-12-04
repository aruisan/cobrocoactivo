<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\RubrosMov;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use Illuminate\Http\Request;

class RubrosMovController extends Controller
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
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function show(RubrosMov $rubrosMov)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function edit(RubrosMov $rubrosMov)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RubrosMov $rubrosMov)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function destroy(RubrosMov $rubrosMov)
    {
        //
    }

    public function movimiento(Request $request, $m, $id)
    {
        if ($m == 1){

            dd($request);

            $fuenteR_id = $request->fuenteR_id;
            $valor_Red  = $request->valorRed;
            $count = count($fuenteR_id);
            $fuente_id_Add = $request->fuente_id;

            for($i = 0; $i < $count; $i++){

                $Frubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                $Frubro->valor_disp = $Frubro->valor_disp - $valor_Red[$i];
                //$Frubro->save();

                $rubrosMov = new RubrosMov();
                $rubrosMov->valor = $valor_Red[$i];
                $rubrosMov->fonts_rubro_id = $fuenteR_id[$i];
                $rubrosMov->fonts_id = $fuente_id_Add[$i];
                $rubrosMov->rubro_id = $id;
                $rubrosMov->movimiento = $m;
                //$rubrosMov->save();

                $FAdd = FontsRubro::where([['rubro_id', $id],['font_id', '=', $fuente_id_Add[$i]]])->get();
                $count2 = $FAdd->count();
                for($x = 0; $x < $count2; $x++){
                    dd($FAdd);
                    $FAdd->valor_disp = $FAdd->valor_disp + $valor_Red[$i];
                    //$FAdd->save();
                }
            }

            Session::flash('success','La adición se realizo correctamente');
            return redirect('/presupuesto/rubro/',$id);

        } elseif ($m == 2){
            dd($request, $m, $id);
        }
    }
}
