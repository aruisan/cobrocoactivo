<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Model\Administrativo\OrdenPago\OrdenPagosPuc;
use App\Model\Administrativo\Contabilidad\Puc;
use App\Http\Controllers\Controller;
use App\Model\Administrativo\Contabilidad\RegistersPuc;
use foo\bar;
use Illuminate\Http\Request;
use Session;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lvl($level)
    {
        $PUC = Puc::find('1');
        if ($PUC){
            $nivel = LevelPUC::where('puc_id', $PUC->id)->where('level', $level)->first();
            $niveles = LevelPUC::where('puc_id', $PUC->id)->get();

            $codes = RegistersPuc::where('level_puc_id', $nivel->id)->get();

            $conteo = RegistersPuc::where('level_puc_id', $nivel->id)->count();

            if($conteo == 0){
                $fila = $nivel->rows;
            }else if($conteo >= $nivel->rows){
                $fila = 0;
            }else if( $nivel->rows > $conteo){
                $fila = $nivel->rows - $conteo;
            }

            foreach ($codes as $code){
                foreach ($code->codes as $data){
                    $reg = RegistersPuc::findOrFail($data->registers_puc_id);
                    if ($reg->codes){
                        foreach ($reg->codes as $data2){
                            $reg2 = RegistersPuc::findOrFail($data2->registers_puc_id);
                            if ($reg2->codes){
                                foreach ($reg2->codes as $data3){
                                    $reg3 = RegistersPuc::findOrFail($data3->registers_puc_id);
                                    if ($reg3->rubro){
                                        foreach ($reg3->rubro as $rubro){
                                            //dd($rubro->op_puc);
                                        }
                                    }else {
                                        $values[] = collect(['debito' => 0, 'credito' => 0]);
                                    }
                                }
                            } else {
                                $values[] = collect(['debito' => 0, 'credito' => 0]);
                            }
                        }
                    } else{
                        $values[] = collect(['debito' => 0, 'credito' => 0]);
                    }
                }
            }

            return view('administrativo.contabilidad.informes.index', compact('nivel', 'niveles', 'fila', 'codes'));
        } else {
            Session::flash('error','Actualmente no existe un PUC para poder ver los informes. Se recomienda crearlo.');
            return back();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
