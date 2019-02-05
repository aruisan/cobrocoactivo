<?php

namespace App\Http\Controllers\Administrativo\GestionDocumental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloInicial;
use App\User;
use App\Model\Persona;
use App\Correspondencia;


class CorrespondenciaController extends Controller
{
    public function index()
    {
        $correspondencia = correspondencia::all();
        return view('administrativo.gestiondocumental.correspondencia.index')->with('datos', $correspondencia);
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

        dd($request);
        Correspondencia::store($request);
       
        return redirect()->route('correspondencia.index')
        				->with('success','La correspondencia con responsable: '.$request->responsable.' se ha creado satisfactoriamente');
    }
}
