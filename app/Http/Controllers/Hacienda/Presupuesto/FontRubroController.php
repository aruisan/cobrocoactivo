<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Hacienda\Presupuesto\Rubro;

use Session;

use Illuminate\Http\Request;

class FontRubroController extends Controller
{
	public function store(request $request)
	{
		//dd($request);
		$id         = $request->fontRubro_id;
        $font       = $request->font_id;
        $valor       = $request->valor;
        $rubro   = $request->rubro_id;

        $count = count($valor);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $font[$i], $valor[$i]);      
            }else{          
                $fontRubro = new FontsRubro();
                $fontRubro->valor = $valor[$i];
                $fontRubro->valor_disp = $valor[$i];
                $fontRubro->rubro_id = $rubro;
                $fontRubro->font_vigencia_id = $font[$i];
                $fontRubro->save();
            }
        }

       return  back();
	}

	public function update($id, $font, $valor)
    {
    	$fontRubro = FontsRubro::findOrFail($id);
        $fontRubro->valor = $valor;
        $fontRubro->valor_disp = $valor;
        $fontRubro->font_vigencia_id = $font;
        $fontRubro->save();
    }




    public function show($id)
    {
        $rubro = Rubro::find($id);
        //dd($rubro->vigencia->fonts[0]->fontsRubro);
        return view('hacienda.presupuesto.vigencia.createFontsRubro', compact('rubro'));
    }



    public function destroy($id)
    {
        $proyecto = FontsRubro::find($id);
        Session::flash('error','Fuente del rubro Eliminada del Rubro correctamente');
        $proyecto->delete();
    }
}
