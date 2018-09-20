<?php

namespace App\Http\Controllers\Administrativo\MedioAmbiente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class PodaArbolController extends Controller
{
     public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'poda arboles')->get();
        return view('administrativo/medioambiente/podaarboles/index')->with('consulta', $consulta);
    }

    public function create()
    {
        return view('administrativo/medioambiente/podaarboles/create');

    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'poda arboles';
        $ingresar->save();

        return redirect()->route('podaarboles.index')
        				->with('success','La poda de arbol con responsable: '.$request->responsable.' se ha creado satisfactoriamente');
    }
}
