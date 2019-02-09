<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Traits\ResourceTraits;
use App\Model\Administrativo\GestionDocumental\Documents;
use Illuminate\Support\Facades\Storage;
use Session;

class BoletinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Boletines = Documents::where('type','=','Boletines')->get();
        return view('administrativo.gestiondocumental.boletines.index', compact('Boletines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idResp = auth()->user()->id;
        return view('administrativo.gestiondocumental.boletines.create', compact('idResp'));
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
        $resource = $file->resource($request->fileBoletines, 'public/Boletines');

        $user_id = $request->id_resp;
        $type = "Boletines";
        $name = $request->name;
        $ff_doc = $request->ff_doc;
        $estado   = '0';
        $cc_id = $request->consecutivo;
        $resource_id   = $resource;

        $Documents = new Documents();
        $Documents->ff_document = $ff_doc;
        $Documents->ff_salida = $ff_doc;
        $Documents->ff_primerdbte = $ff_doc;
        $Documents->ff_segundodbte = $ff_doc;
        $Documents->ff_aprobacion = $ff_doc;
        $Documents->ff_sancion = $ff_doc;
        $Documents->ff_vence = $ff_doc;
        $Documents->type = $type;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->respuesta = $name;
        $Documents->number_doc = 0;
        $Documents->estado = $estado;
        $Documents->resource_id = $resource_id;
        $Documents->user_id = $user_id;
        $Documents->save();

        Session::flash('success','El boletin '.$name.' se ha almacenado exitosamente');
        return redirect('/dashboard/boletines/');
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
        return view('administrativo.gestiondocumental.boletines.edit', compact('Document'));
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
        $ff_doc = $request->ff_doc;
        $cc_id = $request->consecutivo;

        $Documents = Documents::findOrFail($id);
        $Documents->ff_document = $ff_doc;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->save();

        Session::flash('success','El boletin se ha actualizado exitosamente');
        return redirect('/dashboard/boletines/');
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


        Session::flash('error','El boletin se ha eliminado exitosamente');
        return redirect('/dashboard/boletines/');
    }
}
