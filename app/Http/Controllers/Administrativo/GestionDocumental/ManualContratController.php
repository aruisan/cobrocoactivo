<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Traits\ResourceTraits;
use App\Model\Administrativo\GestionDocumental\Documents;
use Illuminate\Support\Facades\Storage;
use Session;


class ManualContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idResp = auth()->user()->id;
        return view('administrativo.gestiondocumental.archivo.createMC', compact('idResp'));
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
        $resource = $file->resource($request->fileManualC, 'public/ManualContratacion');

        $user_id    = $request->id_resp;
        $ff_doc = $request->ff_doc;
        $año = substr($ff_doc, 0, 4);
        $type       = 'Manual de contratación';
        $name    = "Manual de contratación del $año";

        $Documents = new Documents();
        $Documents->ff_document = $ff_doc;
        $Documents->ff_salida = $ff_doc;
        $Documents->ff_primerdbte = $ff_doc;
        $Documents->ff_segundodbte = $ff_doc;
        $Documents->ff_aprobacion = $ff_doc;
        $Documents->ff_sancion = $ff_doc;
        $Documents->ff_vence = $ff_doc;
        $Documents->type = $type;
        $Documents->cc_id = 0;
        $Documents->name = $name;
        $Documents->respuesta = 0;
        $Documents->number_doc = 0;
        $Documents->estado = '0';
        $Documents->resource_id = $resource;
        $Documents->user_id = $user_id;
        $Documents->save();

        Session::flash('success','El manual de contratación se ha almacenado exitosamente');
        return redirect('/dashboard/archivo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Manual = Documents::findOrFail($id);
        return view('administrativo.gestiondocumental.archivo.showMC', compact('Manual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

        Session::flash('error','El manual de contratación se ha eliminado exitosamente');
        return redirect('/dashboard/archivo/');
    }
}
