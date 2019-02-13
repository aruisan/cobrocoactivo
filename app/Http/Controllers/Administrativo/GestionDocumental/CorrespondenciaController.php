<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Resource;
use App\Correspondencia;
use App\Model\Administrativo\GestionDocumental\Documents;
use App\Model\Persona;
use Session;

class CorrespondenciaController extends Controller
{
    public function index()
    {
        $CorrespondenciaE = Documents::where('type','=','Correspondencia entrada')->get();
        $CorrespondenciaS = Documents::where('type','=','Correspondencia salida')->get();
        return view('administrativo.gestiondocumental.correspondencia.index', compact('CorrespondenciaE','CorrespondenciaS'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if ($id == 0 ){
            $tipo = "Entrada";
        } elseif ($id == 1){
            $tipo = "Salida";
        }

        $idResp = auth()->user()->id;
        $users = User::all();
        $terceros = Persona::all();
        return view('administrativo.gestiondocumental.correspondencia.create',compact('id','tipo', 'terceros', 'users','idResp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Correspondencia::store($request);
        return redirect()->route('correspondencia.index')
        				->with('success','La correspondencia se ha creado satisfactoriamente');
    }

    public function show($id)
    {
        $CorrespondenciaE = Documents::findOrFail($id);
        if ($CorrespondenciaE->estado == 0){
            $estado = "Pendiente";
        } elseif ($CorrespondenciaE->estado == 1){
            $estado = "Aprovado";
        } elseif ($CorrespondenciaE->estado == 2){
            $estado = "Rechazado";
        } elseif ($CorrespondenciaE->estado == 3){
            $estado = "Archivado";
        }
        return view('administrativo.gestiondocumental.correspondencia.show', compact('CorrespondenciaE','estado'));
    }

    public function edit($id)
    {
        $users = User::all();
        $terceros = Persona::all();
        $CorrespondenciaE = Documents::findOrFail($id);
        return view('administrativo.gestiondocumental.correspondencia.edit',compact('terceros', 'users','CorrespondenciaE'));
    }

    public function update(Request $request, $id)
    {
        if ($request->tipo_doc == "Correspondencia entrada"){

            $name = $request->name;
            $ff_doc = $request->ff_doc;
            $tercero_id = $request->tercero;
            $number_doc = $request->num_doc;
            $ff_vence = $request->ff_vence;
            $estado = $request->estado;
            $cc_id = $request->cc_id;
            $ff_salida = $request->ff_salida;
            $ff_aprobacion = $request->ff_aprobacion;
            $respuesta = $request->respuesta;

            $Documents = Documents::findOrFail($id);
            $Documents->ff_document = $ff_doc;
            $Documents->ff_salida = $ff_salida;
            $Documents->ff_aprobacion = $ff_aprobacion;
            $Documents->ff_vence = $ff_vence;
            $Documents->cc_id = $cc_id;
            $Documents->name = $name;
            $Documents->respuesta = $respuesta;
            $Documents->number_doc = $number_doc;
            $Documents->estado = $estado;
            $Documents->tercero_id = $tercero_id;
            $Documents->save();

            Session::flash('success','La correspondencia se ha actualizado exitosamente');
            return redirect('/dashboard/correspondencia/'.$id);

        }elseif ($request->tipo_doc == "Correspondencia salida"){

            $name = $request->name;
            $ff_doc = $request->ff_doc;
            $tercero_id = $request->tercero;
            $estado = $request->estado;
            $cc_id = $request->cc_id;
            $ff_salida = $request->ff_salida;
            $ff_aprobacion = $request->ff_aprobacion;
            $respuesta = $request->respuesta;

            $Documents = Documents::findOrFail($id);
            $Documents->ff_document = $ff_doc;
            $Documents->ff_aprobacion = $ff_aprobacion;
            $Documents->ff_salida = $ff_salida;
            $Documents->cc_id = $cc_id;
            $Documents->name = $name;
            $Documents->respuesta = $name;
            $Documents->estado = $estado;
            $Documents->tercero_id = $tercero_id;
            $Documents->respuesta = $respuesta;
            $Documents->save();

            Session::flash('success','La correspondencia se ha actualizado exitosamente');
            return redirect('/dashboard/correspondencia/'.$id);
        }
    }

    public function destroy($id)
    {
        $Document = Documents::findOrFail($id);
        $archivo = Resource::findOrFail($Document->resource_id);
        Storage::delete($archivo->ruta);
        $Document->delete();
        $archivo->delete();

        Session::flash('error','La correspondencia se ha eliminado exitosamente');
        return redirect('/dashboard/correspondencia/');
    }
}
