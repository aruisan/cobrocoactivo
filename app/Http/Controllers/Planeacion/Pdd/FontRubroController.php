<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use App\FontsRubro;
use App\Rubro;

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
                $fontRubro->rubro_id = $rubro;
                $fontRubro->font_id = $font[$i];
                $fontRubro->save();
            }
        }

       return  back();
	}

	public function update($id, $font, $valor)
    {
    	$fontRubro = FontsRubro::findOrFail($id);
        $fontRubro->valor = $valor;
        $fontRubro->font_id = $font;
        $fontRubro->save();
    }




    public function show($id)
    {
        $rubro = Rubro::find($id);
        return view('presupuesto.vigencia.createFontsRubro', compact('rubro'));
    }



    public function destroy($id)
    {
        $proyecto = FontsRubro::find($id);
        Session::flash('error','Fuente del rubro Eliminada del Rubro correctamente');
        $proyecto->delete();
    }
}
