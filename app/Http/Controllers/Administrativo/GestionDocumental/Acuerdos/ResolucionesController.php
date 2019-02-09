<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental\Acuerdos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\GestionDocumental\Comisiones;
use App\Resource;
use App\Traits\ResourceTraits;
use App\Model\Administrativo\GestionDocumental\Documents;
use Illuminate\Support\Facades\Storage;
use Session;

class ResolucionesController extends Controller
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
        $Comisiones = Comisiones::all();
        return view('administrativo.gestiondocumental.acuerdos.createResoluciones', compact('Comisiones'));
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
        $resource = $file->resource($request->fileResolucion, 'public/Resoluciones');

        $type = "Resoluciones";
        $name = $request->name;
        $ff_doc = $request->ff_doc;
        $comision_id = $request->comision_id;
        $number_doc = '0';
        $ff_salida = $request->ff_doc;
        $estado = '0';
        $cc_id =  $request->cc_id;
        $ff_primerdbt = $request->ff_doc;
        $ff_segundodbt = $request->ff_doc;
        $ff_aprobacion = $request->ff_doc;
        $ff_sancion = $request->ff_doc;
        $resource_id = $resource;

        $Documents = new Documents();
        $Documents->ff_document = $ff_doc;
        $Documents->ff_salida = $ff_salida;
        $Documents->ff_primerdbte = $ff_primerdbt;
        $Documents->ff_segundodbte = $ff_segundodbt;
        $Documents->ff_aprobacion = $ff_aprobacion;
        $Documents->ff_sancion = $ff_sancion;
        $Documents->ff_vence = $ff_doc;
        $Documents->type = $type;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->respuesta = $name;
        $Documents->number_doc = $number_doc;
        $Documents->estado = $estado;
        $Documents->resource_id = $resource_id;
        $Documents->comision_id = $comision_id;
        $Documents->save();

        Session::flash('success','La resolución se ha almacenado exitosamente');
        return redirect('/dashboard/acuerdos/');
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
        $Resolucion = Documents::findOrFail($id);
        $Comisiones = Comisiones::all();
        return view('administrativo.gestiondocumental.acuerdos.editResoluciones', compact('Resolucion','Comisiones'));
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
        $comision_id = $request->comision_id;
        $cc_id =  $request->cc_id;

        $Documents = Documents::findOrFail($id);
        $Documents->ff_document = $ff_doc;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->comision_id = $comision_id;
        $Documents->save();

        Session::flash('success','La resolución se ha actualizado exitosamente');
        return redirect('/dashboard/acuerdos/');
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

        Session::flash('error','La resolución se ha eliminado exitosamente');
        return redirect('/dashboard/acuerdos/');
    }
}
