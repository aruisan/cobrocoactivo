<?php

namespace App\Http\Controllers\Administrativo\Registro;

use App\Model\Administrativo\Registro\CdpsRegistro;
use App\Model\Administrativo\Cdp\Cdp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class CdpsRegistroController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registro_id = $request->registro_id;
        $cdps = $request->cdp_id;
        $cdpsRegistroId = $request->cdps_registro_id;
        $valor = $request->valor;

        if ($cdps != null) {
            $count = count($cdps);

            for($i = 0; $i < $count; $i++){

                $cdpsRegistro = new CdpsRegistro();
                $cdpsRegistro->registro_id = $registro_id;
                $cdpsRegistro->cdp_id = $cdps[$i];
                $cdpsRegistro->valor = 0;
                $cdpsRegistro->save();
            }
        }

        if ($cdpsRegistroId != null){

            $countV = count($cdpsRegistroId);

            for($i = 0; $i < $countV; $i++){
                $this->updateV($cdpsRegistroId[$i], $valor[$i]);
            }

        }

        Session::flash('success','Cdps asignados correctamente');
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CdpsRegistro  $cdpsRegistro
     * @return \Illuminate\Http\Response
     */
    public function show(CdpsRegistro $cdpsRegistro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CdpsRegistro  $cdpsRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit(CdpsRegistro $cdpsRegistro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CdpsRegistro  $cdpsRegistro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CdpsRegistro $cdpsRegistro)
    {
        //
    }

    public function updateV($id,$valor)
    {
        $cambiarValor = CdpsRegistro::findOrFail($id);
        $cambiarValor->valor = $valor;
        $cambiarValor->save();
    }

    public function destroy($id)
    {
        $cdpsRegistro = CdpsRegistro::find($id);
        Session::flash('error','CDP eliminado correctamente del registro');
        $cdpsRegistro->delete();
    }
}
