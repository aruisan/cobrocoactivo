<?php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class ContractualController extends Controller
{
    public function index()
    {
        $dependencia = auth()->user()->dependencia_id;
        $usuario = auth()->id();

        $consulta = DB::table('modulo_inicial')
        ->join('users','modulo_inicial.user_id','=','users.id')
        ->join('dependencias','users.dependencia_id','=','dependencias.id')
        ->select('modulo_inicial.id','modulo_inicial.modulo','modulo_inicial.responsable','modulo_inicial.valor','modulo_inicial.asunto')
        ->where('modulo_inicial.modulo', '=', 'contractual')
        ->where('dependencias.id','=',$dependencia)
        ->get();

        // $consulta = ModuloInicial::where('modulo', '=', 'contractual')
        // ->where('user_id','=',$usuario)
        // ->get();
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
