<?php

namespace App\Http\Controllers\Administrativo\Contractual;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Contractuall\Contractual;
use App\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

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
    }

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

    public function edit($id)
    {
        $data = Contractual::findOrFail($id);
        return view('administrativo.contractual.edit', compact('data','id'));
    }

    public function update(Request $request, $id)
    {
        $store= Contractual::findOrFail($id);
        $store->responsable = $request->responsable;
        $store->valor = $request->valor;
        $store->asunto = $request->asunto;
        $store->save();

        Session::flash('success','El contrato de '.$request->responsable.' se edito exitosamente.');
        return  redirect('../contractual/');
    }

    public function destroy($id)
    {
        $data = Contractual::find($id);

        if($data->registro != null){
            Session::flash('warning', 'Tiene '.$data->registro->count().' Registros Relacionados a este Contrato.');
            return redirect('/contractual');
        }else{
            $data->delete();
            Session::flash('error','Contrato borrado correctamente');
            return redirect('/contractual');
        }
    }
}
