<?php

namespace App\Http\Controllers\Convivencia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class ComparendoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'comparendos')->get();
        return view('convivencia/comparendos/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('convivencia.comparendos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->valor  = $request->valor;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'comparendos';
        $ingresar->save();

        return redirect()->route('comparendos.index')
        				->with('success','el comparendo con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
