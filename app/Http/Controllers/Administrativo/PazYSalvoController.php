<?php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class PazYSalvoController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'paz y salvo')->get();
        return view('administrativo/pazysalvo/index')->with('consulta', $consulta);
    }

    public function create()
    {
    	return view('administrativo/pazysalvo/create');
    }

    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'paz y salvo';
        $ingresar->save();
       
        return redirect()->route('pazysalvo.index')
        					->with('success', 'El paz y salvo con responsable: '.$request->responsable.' se ha creado satisfactoriamente');
    }
}
