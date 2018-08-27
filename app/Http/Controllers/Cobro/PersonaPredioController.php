<?php

namespace App\Http\Controllers\Cobro;
use App\Model\Cobro\Predio;
use App\Model\Cobro\PersonaPredio;

use Illuminate\Http\Request;
use Session;

class PersonaPredioController extends Controller
{


    
    public function store(Request $request)
    {
        
        
    }




    public function show($id)
    {
        $predio = Predio::findOrFail($id);

        return view('personas-predios.index', ['predio' => $predio]);
        Session::flash('message', 'Se ha asignado el Propietario al Predio');
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
      

    }


    public function destroy($id)
    {

        $persona = PersonaPredio::where('persona_id', $id)->first();

        $persona->delete();

        return back();
    }

    public function predioAsignarPersona(Request $request)
    {
    	$create = PersonaPredio::Create($request->all());

        return redirect()->action(
            'PersonaPredioController@show', ['id' => $create->predio_id]
        );

        Session::flash('message', 'Se ha asignado el Propietario al Predio');
    }

  
}
