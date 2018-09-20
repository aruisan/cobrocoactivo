<?php

namespace App\Http\Controllers\Sansonatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class AdministrativoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'administrativos')->get();
        return view('sansonatorio.administrativos.index')->with('consulta', $consulta);
    }

    public function create()
    {
        return view('sansonatorio.administrativos.create');
    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->valor  = $request->valor;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'administrativos';
        $ingresar->save();
 
        return redirect()->route('administrativos.index')
        				->with('success', 'el administrativo con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
