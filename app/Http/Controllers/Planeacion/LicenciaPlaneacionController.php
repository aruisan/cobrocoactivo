<?php

namespace App\Http\Controllers\Planeacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class LicenciaPlaneacionController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'licencias de planeacion')->get();
        return view('planeacion/licenciasplaneacion/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planeacion/licenciasplaneacion/create');
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
        $ingresar->modulo = 'licencias de planeacion';
        $ingresar->save();

        return redirect()->route('licenciasplaneacion.index')
        					->with('success','La liciencia de planeación con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
