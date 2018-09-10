<?php

namespace App\Http\Controllers\Administrativo\Contractual;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Administrativo\Hacienda\Presupuesto\Rubro;
use App\Http\Controllers\Controller;

class VerRubrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencia = auth()->user()->dependencia_id;
        $usuario = auth()->id();

        $consulta = DB::table('rubros')
        ->join('sub_proyectos','rubros.subproyecto_id','=','sub_proyectos.id')
        ->join('dependencias','sub_proyectos.dependencia_id','=','dependencias.id')
        ->select('rubros.cod as cod','rubros.name as rubro','dependencias.name as dependencia','sub_proyectos.name as subproyecto')
        ->where('dependencias.id','=',$dependencia)
        ->get();
        
        return view('administrativo.contractual.rubrosAsignados')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hacienda.almacen.index');
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
