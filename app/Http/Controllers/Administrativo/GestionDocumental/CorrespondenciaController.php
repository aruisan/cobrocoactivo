<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;

class CorrespondenciaController extends Controller
{
    public function index()
    {
        $consulta = ModuloInicial::where('modulo', '=', 'correspondencia')->get();
        return view('administrativo.gestiondocumental.correspondencia.index')->with('consulta', $consulta);
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
        return view('administrativo.gestiondocumental.correspondencia.create',compact('id','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingresar = new ModuloInicial;
        $ingresar->responsable = $request->responsable;
        $ingresar->asunto = $request->asunto;
        $ingresar->modulo = 'correspondencia';
        $ingresar->save();
        return redirect()->route('correspondencia.index')
        				->with('success','La correspondencia con responsable: '.$request->responsable.' se ha creado satisfactoriamente');
    }
}
