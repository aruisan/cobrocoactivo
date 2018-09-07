<?php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class ContractualController extends Controller
{
    public function index()
    {
        $dependencia = auth()->user()->dependencia_id;
        $usuario = auth()->id();

        $consulta = ModuloInicial::where('modulo', '=', 'contractual')
        ->where('user_id','=',$usuario)
        ->get();
        return view('administrativo/contractual/index')->with('consulta', $consulta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contractual.create');
        ;    }

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
        $ingresar->modulo = 'contractual';
        $ingresar->user_id = auth()->id();
        $ingresar->save();

        return redirect()->route('contractual.index')
        ->with('success','El contractual con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');

    }
}
