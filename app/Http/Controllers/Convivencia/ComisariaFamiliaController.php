<?php

namespace App\Http\Controllers\Convivencia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class ComisariaFamiliaController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'comisaria de familia')->get();
        return view('convivencia/comisariafamilia/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('convivencia.comisariafamilia.create');
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
        $ingresar->modulo = 'comisaria de familia';
        $ingresar->save();

        return redirect()->route('comisariafamilia.index')
        				->with('success','la comisaria de familia con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');
    }
}
