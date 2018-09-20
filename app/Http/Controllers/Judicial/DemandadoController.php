<?php

namespace App\Http\Controllers\Judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class DemandadoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'demandado')->get();
        return view('judicial/demandado/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('judicial.demandado.create');
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
        $ingresar->modulo = 'demandado';
        $ingresar->save();
        
        return redirect()->route('demandado.index')
        				->with('success','El demandado con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
