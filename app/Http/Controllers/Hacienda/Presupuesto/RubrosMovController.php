<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\RubrosMov;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use Illuminate\Http\Request;
use App\Traits\ResourceTraits;
use App\Resource;
use Illuminate\Support\Facades\Storage;

use Session;

class RubrosMovController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function show(RubrosMov $rubrosMov)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function edit(RubrosMov $rubrosMov)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function update($id, $idF, $valor, $idFR, $idR)
    {
        $movim = RubrosMov::findOrFail($id);
        $valorAnterior = $movim->valor;
        $idFAnterior = $movim->fonts_id;

        $Frubro = FontsRubro::findOrFail($idFR);

        $Frubro->valor_disp = $Frubro->valor_disp + $valorAnterior;
        $Frubro->valor_disp = $Frubro->valor_disp - $valor;
        $Frubro->save();

        if ($idF != $idFAnterior){
            $FAdd = FontsRubro::where([['rubro_id', $idR],['font_id', '=', $idFAnterior]])->get();
            $count2 = $FAdd->count();

            for($x = 0; $x < $count2; $x++){
                $FAdd[$x]->valor_disp = $FAdd[$x]->valor_disp - $valorAnterior;
                $FAdd[$x]->save();
            }

            $FAdd2 = FontsRubro::where([['rubro_id', $idR],['font_id', '=', $idF]])->get();
            $count3 = $FAdd2->count();

            for($y = 0; $y < $count3; $y++){
                $FAdd2[$y]->valor_disp = $FAdd2[$y]->valor_disp + $valor;
                $FAdd2[$y]->save();
            }

        } else{

            $FAdd = FontsRubro::where([['rubro_id', $idR],['font_id', '=', $idF]])->get();
            $count2 = $FAdd->count();

            for($x = 0; $x < $count2; $x++){
                $FAdd[$x]->valor_disp = $FAdd[$x]->valor_disp - $valorAnterior;
                $FAdd[$x]->valor_disp = $FAdd[$x]->valor_disp + $valor;
                $FAdd[$x]->save();
            }
        }

        $mov = RubrosMov::findOrFail($id);
        $mov->fonts_id = $idF;
        $mov->valor = $valor;
        $mov->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RubrosMov  $rubrosMov
     * @return \Illuminate\Http\Response
     */
    public function destroy(RubrosMov $rubrosMov)
    {
        //
    }

    public function updateMov($idM, $val, $request, $id, $m)
    {
        if ($m == 2){

            $mov = RubrosMov::findOrFail($idM);
            $idResourceD = $mov->resource_id;

            $file = new ResourceTraits;
            $resource = $file->resource($request->fileAdicion, 'public/AdicionyRed');

            $fuenteR_id = $request->fuenteR_id;

            for($i = 0; $i < count( $fuenteR_id); $i++){
                $FontRubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                $FontRubro->valor_disp = $FontRubro->valor_disp - $mov->valor;
                $FontRubro->valor_disp = $FontRubro->valor_disp + $val;
                $FontRubro->save();
            }

            $mov->valor = $val;
            $mov->resource_id = $resource;
            $mov->save();

            $archivo = Resource::findOrFail($idResourceD);
            Storage::delete($archivo->ruta);
            $archivo->delete();

            Session::flash('success','La adición se actualizó correctamente');
            return redirect('/presupuesto/rubro/'.$id);

        }elseif ($m == 3){

            $mov = RubrosMov::findOrFail($idM);
            $idResourceD = $mov->resource_id;

            $file = new ResourceTraits;
            $resource = $file->resource($request->fileReduccion, 'public/AdicionyRed');

            $fuenteB_id = $request->fuenteBase_id;
            $fuenteR_id = $request->fuenteR_id;

            for($i = 0; $i < count( $fuenteR_id); $i++){
                $FontRubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                $FontRubro->valor_disp = $FontRubro->valor_disp + $mov->valor;
                $FontRubro->valor_disp = $FontRubro->valor_disp - $val;
                $FontRubro->save();
            }

            $mov->valor = $val;
            $mov->resource_id = $resource;
            $mov->save();

            $archivo = Resource::findOrFail($idResourceD);
            Storage::delete($archivo->ruta);
            $archivo->delete();

            Session::flash('success','La reducción se actualizó correctamente');
            return redirect()->action('Hacienda\Presupuesto\RubrosController@show', [$id]);

        }
    }

    public function movimiento(Request $request, $m, $id)
    {
        if ($m == 1){

            $fuenteR_id = $request->fuenteR_id;
            $valor_Red  = $request->valorRed;
            $count = count($fuenteR_id);
            $fuente_id_Add = $request->fuente_id;
            $rubro_mov_id = $request->rubro_Mov_id;

            for($i = 0; $i < $count; $i++){

                if ($rubro_mov_id[$i]){

                    $this->update($rubro_mov_id[$i], $fuente_id_Add[$i], $valor_Red[$i], $fuenteR_id[$i], $id);

                }else{

                    $Frubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                    $Frubro->valor_disp = $Frubro->valor_disp - $valor_Red[$i];
                    $Frubro->save();

                    $file = new ResourceTraits;
                    $resource = $file->resource($request->fileCyC, 'public/CreditoyCC');

                    $rubrosMov = new RubrosMov();
                    $rubrosMov->valor = $valor_Red[$i];
                    $rubrosMov->fonts_rubro_id = $fuenteR_id[$i];
                    $rubrosMov->fonts_id = $fuente_id_Add[$i];
                    $rubrosMov->rubro_id = $id;
                    $rubrosMov->movimiento = $m;
                    $rubrosMov->resource_id = $resource;
                    $rubrosMov->save();

                    $FAdd = FontsRubro::where([['rubro_id', $id],['font_id', '=', $fuente_id_Add[$i]]])->get();
                    $count2 = $FAdd->count();
                    for($x = 0; $x < $count2; $x++){
                        $FAdd[$x]->valor_disp = $FAdd[$x]->valor_disp + $valor_Red[$i];
                        $FAdd[$x]->save();
                    }

                }

            }

            Session::flash('success','El Credito se realizo correctamente');
            return redirect()->action('Hacienda\Presupuesto\RubrosController@show', [$id]);

        } elseif ($m == 2){

            $fuenteR_id = $request->fuenteR_id;
            $valor = $request->valorCred;
            $mov_id = $request->mov_id;
            $count = count($fuenteR_id);

            for($i = 0; $i < $count; $i++){

                if ($mov_id[$i]){
                    $this->updateMov($mov_id[$i], $valor[$i], $request, $id, $m);
                }else{
                    $FontRubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                    $FontRubro->valor_disp = $FontRubro->valor_disp + $valor[$i];
                    $FontRubro->save();

                    $file = new ResourceTraits;
                    $resource = $file->resource($request->fileAdicion, 'public/AdicionyRed');

                    $rubrosMov2 = new RubrosMov();
                    $rubrosMov2->valor = $valor[$i];
                    $rubrosMov2->fonts_rubro_id = $fuenteR_id[$i];
                    $rubrosMov2->fonts_id = 1;
                    $rubrosMov2->rubro_id = $id;
                    $rubrosMov2->movimiento = $m;
                    $rubrosMov2->resource_id = $resource;
                    $rubrosMov2->save();

                }
            }

            Session::flash('success','La adición se realizo correctamente');
            return redirect()->action('Hacienda\Presupuesto\RubrosController@show', [$id]);

        } elseif ($m == 3){

            $fuenteR2_id = $request->fuenteR_id;
            $valor2 = $request->valorCred;
            $mov_id2 = $request->mov_id;
            $count2 = count($fuenteR2_id);

            for($i = 0; $i < $count2; $i++){

                if ($mov_id2[$i]){
                    $this->updateMov($mov_id2[$i], $valor2[$i], $request, $id, $m);
                }else{
                    $FontRubro2 = FontsRubro::findOrFail($fuenteR2_id[$i]);
                    $FontRubro2->valor_disp = $FontRubro2->valor_disp - $valor2[$i];
                    $FontRubro2->save();

                    $file2 = new ResourceTraits;
                    $resource2 = $file2->resource($request->fileReduccion, 'public/AdicionyRed');

                    $rubrosMov3 = new RubrosMov();
                    $rubrosMov3->valor = $valor2[$i];
                    $rubrosMov3->fonts_rubro_id = $fuenteR2_id[$i];
                    $rubrosMov3->fonts_id = 1;
                    $rubrosMov3->rubro_id = $id;
                    $rubrosMov3->movimiento = $m;
                    $rubrosMov3->resource_id = $resource2;
                    $rubrosMov3->save();
                }
            }

            Session::flash('success','La reducción se realizo correctamente');
            return redirect()->action('Hacienda\Presupuesto\RubrosController@show', [$id]);
        }
    }
}
