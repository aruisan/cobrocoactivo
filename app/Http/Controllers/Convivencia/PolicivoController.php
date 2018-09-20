<?php

namespace App\Http\Controllers\Convivencia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class PolicivoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'policivo')->get();
        return view('convivencia/policivo/index')->with('consulta', $consulta);
    }

    public function create()
    {
        return view('convivencia.policivo.create');

    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->valor  = $request->valor;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'policivo';
        $ingresar->save();
        
        return redirect()->route('policivo.index')
        				->with('success','El policivo con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }

}
