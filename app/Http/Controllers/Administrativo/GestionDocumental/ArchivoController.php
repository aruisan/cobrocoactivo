<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Resource;
use App\Traits\ResourceTraits;
use App\Model\Administrativo\GestionDocumental\Documents;
use Session;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Documents = Documents::where('type','=','Otros documentos')->get();
        $ManualC = Documents::where('type','=','Manual de contratación')->get();
        $PlanA = Documents::where('type','=','Plan de adquisiones')->get();
        return view('administrativo.gestiondocumental.archivo.index', compact('Documents','ManualC','PlanA'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idResp = auth()->user()->id;
        $users = User::all();
        $terceros = User::all();
        return view('administrativo.gestiondocumental.archivo.create', compact('terceros','users','idResp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = new ResourceTraits;
        $resource = $file->resource($request->fileArchivo, 'public/Archivo');

        $user_id    = $request->id_resp;
        $type       = $request->type;
        $name    = $request->name;
        $ff_doc       = $request->fecha_doc;
        $tercero_id   = $request->tercero;
        $number_doc   = $request->num_doc;
        $ff_vence   = $request->ff_vence;
        $estado   = $request->estado;
        $cc_id = $request->consecutivo;
        $resource_id   = $resource;

        $Documents = new Documents();
        $Documents->ff_document = $ff_doc;
        $Documents->ff_salida = $ff_doc;
        $Documents->ff_primerdbte = $ff_doc;
        $Documents->ff_segundodbte = $ff_doc;
        $Documents->ff_aprobacion = $ff_doc;
        $Documents->ff_sancion = $ff_doc;
        $Documents->ff_vence = $ff_vence;
        $Documents->type = $type;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->respuesta = $name;
        $Documents->number_doc = $number_doc;
        $Documents->estado = $estado;
        $Documents->resource_id = $resource_id;
        $Documents->user_id = $user_id;
        $Documents->tercero_id = $tercero_id;
        $Documents->save();

        Session::flash('success','El archivo se ha almacenado exitosamente');
        return redirect('/dashboard/archivo/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Document = Documents::findOrFail($id);
        $terceros = User::all();

       // dd($Document->resource->ruta);

        return view('administrativo.gestiondocumental.archivo.edit', compact('Document','terceros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $ff_doc = $request->fecha_doc;
        $tercero_id = $request->tercero;
        $number_doc = $request->num_doc;
        $ff_vence = $request->ff_vence;
        $estado = $request->estado;
        $cc_id = $request->consecutivo;

        $Documents = Documents::findOrFail($id);
        $Documents->ff_document = $ff_doc;
        $Documents->ff_vence = $ff_vence;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->number_doc = $number_doc;
        $Documents->estado = $estado;
        $Documents->tercero_id = $tercero_id;
        $Documents->save();

        Session::flash('success','El archivo se ha actualizado exitosamente');
        return redirect('/dashboard/archivo/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Document = Documents::findOrFail($id);
        $archivo = Resource::findOrFail($Document->resource_id);
        Storage::delete($archivo->ruta);
        $Document->delete();
        $archivo->delete();

        Session::flash('error','El archivo se ha eliminado exitosamente');
        return redirect('/dashboard/archivo/');
    }
}
