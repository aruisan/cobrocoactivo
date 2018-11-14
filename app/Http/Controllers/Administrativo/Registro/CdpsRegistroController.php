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
        $fuenteRubroId = $request->fuente_id;
        $valorFuente = $request->valorFuenteUsar;
        $rubrosCdpId = $request->rubros_cdp_id;
        $rubrosCdpValorId = $request->rubros_cdp_valor_id;

        $count = count($cdps);

        for($i = 0; $i < $count; $i++){

            $cdpsRegistro = new CdpsRegistro();
            $cdpsRegistro->registro_id = $registro_id;
            $cdpsRegistro->cdp_id = $cdps[$i];
            $cdpsRegistro->save();

            $cdp = Cdp::find($cdps[$i]);
            $valor[] = $cdp->rubrosCdpValor->sum('valor_disp');
        }

        if ($valorFuente != null){

            $countV = count($valorFuente);

            for($i = 0; $i < $countV; $i++){

                if ($rubrosCdpValorId[$i]){
                    $this->updateV($rubrosCdpValorId[$i], $valorFuente[$i]);
                }else{
                    $rubrosCdpValor = new RubrosCdpValor();
                    $rubrosCdpValor->valor = $valorFuente[$i];
                    $rubrosCdpValor->valor_disp = $valorFuente[$i];
                    $rubrosCdpValor->fontsRubro_id = $fuenteRubroId[$i];
                    $rubrosCdpValor->cdp_id = $cdp_id;
                    $rubrosCdpValor->rubrosCdp_id = $rubrosCdpId[$i];
                    $rubrosCdpValor->save();
                }
            }

        }

        //$cdp = Cdp::findOrFail($cdp_id);
        //$cdp->valor = $cdp->valor + array_sum($valor);
        //$cdp->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CdpsRegistro  $cdpsRegistro
     * @return \Illuminate\Http\Response
     */
    public function destroy(CdpsRegistro $cdpsRegistro)
    {
        //
    }
}
