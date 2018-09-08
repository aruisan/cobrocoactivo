<?php

namespace App\Http\Controllers\Administrativo\Contractual;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Contractuall\Contractual;
use App\File;

class ContractualController extends Controller
{
    public function index()
    {
        $dependencia = auth()->user()->dependencia_id;
        $usuario = auth()->id();

        $consulta = DB::table('contractuales')
        ->join('users','contractuales.idUsers','=','users.id')
        ->join('dependencias','users.dependencia_id','=','dependencias.id')
        ->select('contractuales.id','contractuales.modulo','contractuales.responsable','contractuales.valor','contractuales.asunto')
        ->where('contractuales.modulo', '=', 'contractual')
        ->where('dependencias.id','=',$dependencia)
        ->get();

        // $consulta = Contractual::where('modulo', '=', 'contractual')->get();


        // $consulta = ModuloInicial::where('modulo', '=', 'contractual')
        // ->where('idUsers','=',$usuario)
        // ->get();
        return view('administrativo.contractual.index')->with('consulta', $consulta);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.contractual.create');
        ;}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingresar = new Contractual;
        $ingresar->responsable = $request->responsable;
        $ingresar->valor  = $request->valor;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'contractual';
        $ingresar->idUsers = auth()->id();
        $ingresar->save();

        return redirect()->route('contractual.index')
        ->with('success','El contractual con responsable: '.$request->responsable.' y valor $'.$request->valor.' se ha creado satisfactoriamente');

    }
}
