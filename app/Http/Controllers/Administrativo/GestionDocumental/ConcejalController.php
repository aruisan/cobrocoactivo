<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use App\Model\Administrativo\GestionDocumental\Concejal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Persona;
use App\Traits\FileTraits;
use Session;


class ConcejalController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:concejales-list');
         $this->middleware('permission:concejales-create', ['only' => ['create','store']]);
         $this->middleware('permission:concejales-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:concejales-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Concejales = Concejal::all();
        return view('administrativo.gestiondocumental.concejales.index', compact('Concejales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Personas = Persona::all();
        foreach ($Personas as $persona){
            if ($persona->concejal == null){
                $Usuarios[] = collect(['id' => $persona->id, 'name' => $persona->nombre]);
            }
        }
        return view('administrativo.gestiondocumental.concejales.create', compact('Usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = Persona::findOrFail($request->dato_id);
        $file = new FileTraits;
        $ruta = $file->Img($request->file('file'), 'concejales', $persona->num_dc);

        $Concejal = new Concejal();
        $Concejal->partido = $request->partido;
        $Concejal->periodo = $request->periodo;
        $Concejal->dato_id = $request->dato_id;
        $Concejal->save();

        Session::flash('success','El concejal se ha creado exitosamente');
        return redirect('dashboard/concejales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $concejal = Concejal::findOrFail($id);
        $datos = Persona::findOrFail($concejal->dato_id);
        return view('administrativo.gestiondocumental.concejales.edit', compact('concejal','datos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $concejal = Concejal::findOrFail($id);
        $datos = Persona::findOrFail($concejal->dato_id);

        if ($request->file){
            $file = new FileTraits;
            $ruta = $file->Img($request->file('file'), 'concejales', $datos->num_dc);
        }

        $concejal->partido = $request->partido;
        $concejal->periodo = $request->periodo;
        $concejal->save();
        $datos->email = $request->email;
        $datos->direccion = $request->direccion;
        $datos->telefono = $request->telefono;
        $datos->save();

        Session::flash('success','La información del concejal '.$datos->nombre.' se ha actualizado exitosamente');
        return redirect('/dashboard/concejales/'.$concejal->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concejal  $concejal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $concejal = Concejal::findOrFail($id);
        $concejal->delete();

        Session::flash('error','El concejal se ha eliminado exitosamente, recuerde que el usuario aun existe en el modulo de terceros');
        return redirect('/dashboard/concejales/');
    }
}
