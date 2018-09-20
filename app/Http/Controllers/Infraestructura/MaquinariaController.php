<?php

namespace App\Http\Controllers\Infraestructura;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class MaquinariaController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'maquinaria')->get();
        return view('infraestructura/maquinaria/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infraestructura.maquinaria.create');
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
        $ingresar->modulo = 'maquinaria';
        $ingresar->save();

        return redirect()->route('maquinaria.index')
        				->with('success', 'La maquinaria con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }

}
