<?php

namespace App\Http\Controllers\Administrativo\Registro;

use App\Model\Administrativo\Registro\CdpsRegistro;
use App\Model\Administrativo\Registro\CdpsRegistroValor;
use App\Model\Administrativo\Registro\Registro;
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
        $fuenteRubroId = $request->fuente_id;
        $rubroId = $request->rubro_id;
        $cdpId = $request->cdp_id_s;
        $valorRubro = $request->valorFuenteUsar;
        $rubrosCdpId = $request->rubros_cdp_id;
        $rubrosCdpValorId = $request->rubros_cdp_valor_id;
        $registro_id = $request->registro_id;
        $cdps = $request->cdp_id;

        $registro = Registro::findOrFail($registro_id);
        $registro->iva = $request->iva;
        $registro->save();

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

        if ($valorRubro != null){

            $countV = count($valorRubro);

            for($i = 0; $i < $countV; $i++){

                if ($rubrosCdpValorId[$i]){
                    $this->updateV($rubrosCdpValorId[$i], $valorRubro[$i]);
                }else{
                    $cdpsRegistroValor = new CdpsRegistroValor();
                    $cdpsRegistroValor->valor = $valorRubro[$i];
                    $cdpsRegistroValor->valor_disp = $valorRubro[$i];
                    $cdpsRegistroValor->fontsRubro_id = $fuenteRubroId[$i];
                    $cdpsRegistroValor->registro_id = $registro_id;
                    $cdpsRegistroValor->cdp_id = $cdpId[$i];
                    $cdpsRegistroValor->rubro_id = $rubroId[$i];
                    $cdpsRegistroValor->cdps_registro_id = $rubrosCdpId[$i];
                    $cdpsRegistroValor->save();
                }
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
        $cambiarValor = CdpsRegistroValor::findOrFail($id);
        $cambiarValor->valor = $valor;
        $cambiarValor->valor_disp = $valor;
        $cambiarValor->save();
    }

    public function destroy($id)
    {
        $cdpsRegistro = CdpsRegistro::find($id);
        Session::flash('error','CDP eliminado correctamente del registro');
        $cdpsRegistro->delete();
    }
}
