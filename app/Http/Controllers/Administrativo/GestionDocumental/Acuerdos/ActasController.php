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


class ActasController extends Controller
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
        return view('administrativo.gestiondocumental.acuerdos.createActas', compact('Comisiones'));
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
        $resource = $file->resource($request->fileActa, 'public/Actas');

        $type = "Actas";
        $name = $request->name;
        $ff_doc = $request->ff_doc;
        $comision_id = $request->comision_id;
        $number_doc = '0';
        $ff_salida = $request->ff_doc;
        $estado = $request->estado;
        $cc_id =  $request->cc_id;
        $ff_primerdbt = $request->ff_doc;
        $ff_segundodbt = $request->ff_doc;
        $ff_aprobacion = $request->ff_aprobacion;
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

        Session::flash('success','El acta se ha almacenado exitosamente');
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
        $Acta = Documents::findOrFail($id);
        $Comisiones = Comisiones::all();
        return view('administrativo.gestiondocumental.acuerdos.editActas', compact('Acta','Comisiones'));
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
        $estado = $request->estado;
        $cc_id =  $request->cc_id;
        $ff_aprobacion = $request->ff_aprobacion;

        $Documents = Documents::findOrFail($id);
        $Documents->ff_document = $ff_doc;
        $Documents->ff_aprobacion = $ff_aprobacion;
        $Documents->cc_id = $cc_id;
        $Documents->name = $name;
        $Documents->estado = $estado;
        $Documents->comision_id = $comision_id;
        $Documents->save();

        Session::flash('success','El acta se ha actualizado exitosamente');
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

        Session::flash('error','El acta se ha eliminado exitosamente');
        return redirect('/dashboard/acuerdos/');
    }
}
