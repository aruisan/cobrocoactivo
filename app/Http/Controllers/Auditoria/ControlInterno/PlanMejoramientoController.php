<?php

namespace App\Http\Controllers\Auditoria\ControlInterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;


class PlanMejoramientoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'plan de mejoramiento')->get();
        return view('auditoria/controlinterno/planmejoramiento/index')->with('consulta', $consulta);
    }

    public function create()
    {
    	return view('auditoria/controlinterno/planmejoramiento/create');
    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'plan de mejoramiento';
        $ingresar->save();

        return redirect()->route('planmejoramiento.index')
        				->with('success', 'El plan de mejoramiento con responsable: '.$request->responsable.' se ha creado satisfactoriamente');
    }
}
