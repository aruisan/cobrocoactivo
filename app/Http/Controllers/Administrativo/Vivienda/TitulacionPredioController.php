<?php

namespace App\Http\Controllers\Administrativo\Vivienda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class TitulacionPredioController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'titulacion de predios')->get();
        return view('administrativo/vivienda/titulacionpredios/index')->with('consulta', $consulta);
    }

     public function create()
    {
        return view('administrativo/vivienda/titulacionpredios/create');

    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->valor  = $request->valor;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'titulacion de predios';
        $ingresar->save();
        return redirect()->route('titulacionpredios.index')
        				->with('success','La titulación de predios con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    
    }
}
