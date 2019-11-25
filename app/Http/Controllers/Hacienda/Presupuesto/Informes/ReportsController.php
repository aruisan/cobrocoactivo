<?php

namespace App\Http\Controllers\Hacienda\Presupuesto\Informes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\Register;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Hacienda\Presupuesto\Vigencia;

class ReportsController extends Controller
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
    public function lvl($level){

        $register = Register::all();
        $levels = Level::all();
        $vigencia = Vigencia::where('vigencia', 2019)->where('tipo', 0)->get();

        foreach ( $register as $register){
            if ($register->level_id == $level){
                $values[] = collect(['id' => $register->id, 'name' => $register->name, 'code' => $register->code]);
            }
        }

        $lvl = $level;

        return view('hacienda.presupuesto.informes.index', compact('values', 'levels','vigencia','lvl'));
    }

    public function rubros($id){
        $values = Rubro::where('vigencia_id', $id)->get();
        $levels = Level::all();

        return view('hacienda.presupuesto.informes.indexR', compact('values', 'levels'));
    }

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
