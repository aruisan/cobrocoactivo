<?php

namespace App\Http\Controllers\Sansonatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class DisciplinarioController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'disciplinario')->get();
        return view('sansonatorio/disciplinarios/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sansonatorio/disciplinarios/create');
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
        $ingresar->modulo = 'disciplinario';
        $ingresar->save();

        return redirect()->route('disciplinarios.index')
        				->with('success','El disciplinario con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
