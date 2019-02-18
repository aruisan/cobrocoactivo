<?php

namespace App\Http\Controllers\Administrativo\Contractual;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Contractuall\Contractual;
use App\Model\Administrativo\Contractuall\Anexos;
use App\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Resource;
use App\Traits\ResourceTraits;
use Illuminate\Support\Facades\Storage;
use App\Model\Administrativo\Registro\Registro;

class ContractualController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:contractual-list');
         $this->middleware('permission:contractual-create', ['only' => ['create','store']]);
         $this->middleware('permission:contractual-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:contractual-delete', ['only' => ['destroy']]);
    }  


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

    public function anexos($id)
    {
        $Contrato = Contractual::findOrFail($id);
        $Anexos = Anexos::where('contractual_id','=',$id)->get();
        return view('administrativo.contractual.anexos', compact('Anexos','Contrato'));
    }

    public function anexosCreate($id)
    {
        $Contrato = Contractual::findOrFail($id);
        return view('administrativo.contractual.anexosCreate', compact('Contrato'));
    }

    public function anexosStore(Request $request, $id)
    {
        $file = new ResourceTraits;
        $resource = $file->resource($request->fileAnexos, 'public/Contractual');

        $name    = $request->name;
        $ff_doc       = $request->ff_doc;
        $num_doc   = $request->num_doc;
        $ff_vence   = $request->ff_vence;
        $estado   = $request->estado;
        $cc_id = $request->consecutivo;
        $resource_id   = $resource;

        $Anexos = new Anexos();
        $Anexos->ff_doc = $ff_doc;
        $Anexos->ff_vence = $ff_vence;
        $Anexos->consecutivo = $cc_id;
        $Anexos->name = $name;
        $Anexos->num_doc = $num_doc;
        $Anexos->estado = $estado;
        $Anexos->resource_id = $resource_id;
        $Anexos->contractual_id = $id;
        $Anexos->save();

        Session::flash('success','El anexo se ha almacenado exitosamente');
        return redirect('/contractual/'.$id.'/anexos');
    }

    public function anexosUpdate(Request $request, $id)
    {
        if (isset($request->fileAnexosU)){

            $AnexoUp2 = Anexos::findOrFail($id);
            $archivo = Resource::findOrFail($AnexoUp2->resource_id);

            $file = new ResourceTraits;
            $resource = $file->resource($request->fileAnexosU, 'public/Contractual');

            $name    = $request->name;
            $ff_doc       = $request->ff_doc;
            $num_doc   = $request->num_doc;
            $ff_vence   = $request->ff_vence;
            $estado   = $request->estado;
            $cc_id = $request->consecutivo;
            $resource_id   = $resource;

            $AnexoUp2->ff_doc = $ff_doc;
            $AnexoUp2->ff_vence = $ff_vence;
            $AnexoUp2->consecutivo = $cc_id;
            $AnexoUp2->name = $name;
            $AnexoUp2->num_doc = $num_doc;
            $AnexoUp2->estado = $estado;
            $AnexoUp2->resource_id = $resource_id;
            $AnexoUp2->save();

            Storage::delete($archivo->ruta);
            $archivo->delete();

            Session::flash('success','El anexo se ha actualizado exitosamente');
            return redirect('/contractual/'.$AnexoUp2->contractual_id.'/anexos');

        }else{

            $name = $request->name;
            $ff_doc = $request->ff_doc;
            $num_doc = $request->num_doc;
            $ff_vence = $request->ff_vence;
            $estado = $request->estado;
            $cc_id = $request->consecutivo;

            $AnexoUp = Anexos::findOrFail($id);
            $AnexoUp->ff_doc = $ff_doc;
            $AnexoUp->ff_vence = $ff_vence;
            $AnexoUp->consecutivo = $cc_id;
            $AnexoUp->name = $name;
            $AnexoUp->num_doc = $num_doc;
            $AnexoUp->estado = $estado;
            $AnexoUp->save();

            Session::flash('success','El anexo se ha actualizado exitosamente');
            return redirect('/contractual/'.$AnexoUp->contractual_id.'/anexos');
        }
    }

    public function anexosDelete($id){

        $Anexo = Anexos::findOrFail($id);
        $contrato = $Anexo->contractual_id;
        $archivo = Resource::findOrFail($Anexo->resource_id);
        Storage::delete($archivo->ruta);
        $Anexo->delete();
        $archivo->delete();

        Session::flash('error','El anexo se ha eliminado exitosamente');
        return redirect('/contractual/'.$contrato.'/anexos');
    }

    public function anexosEdit($id)
    {
        $Anexo = Anexos::findOrFail($id);
        return view('administrativo.contractual.anexosEdit', compact('Anexo','id'));
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
        $anexos = Anexos::where('contractual_id','=',$id)->get();
        $registros = Registro::where('contrato_id','=',$id)->get();

        if (count($anexos) > 0){
            Session::flash('warning', 'Tiene '.count($anexos).' Anexos Relacionados a este Contrato. Elimine los anexos para poder eliminar el contrato');
            return redirect('/contractual/'.$id.'/edit');
        }else{
            if (count($registros) > 0){
                Session::flash('warning', 'Tiene '.count($registros).' Registros Relacionados a este Contrato. Elimine los registros para poder eliminar el contrato');
                return redirect('/contractual/'.$id.'/edit');
            }else{
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
    }
}
