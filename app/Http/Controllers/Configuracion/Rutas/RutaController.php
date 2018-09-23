<?php

namespace App\Http\Controllers\Configuracion\Rutas;

use App\Http\Controllers\Controller;
use App\Model\Admin\Dependencia;
use App\Model\Cobro\Ruta;
use App\Model\Cobro\Type;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutas = Ruta::orderBy('id','DESC')->paginate(10);
        return view('configuracion.ruta.index',compact('rutas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('configuracion.ruta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruta =  new Ruta;
        $ruta->nombre = $request->nombre;    
    
        $ruta->save();

       return redirect()->route('ruta.orden', $ruta->id)
                        ->with('success','Ruta creada Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('ruta.orden', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $ruta = Ruta::find($id); 

       return view('configuracion.ruta.edit', compact('ruta'));
                        
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
        $update = Ruta::find($id);
        $update->nombre = $request->nombre;    
    
        $update->save();
        return redirect()->route('rutas.index')
                        ->with('success','Ruta Editada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruta = Ruta::find($id)->delete();
        return redirect()->route('rutas.index')
                        ->with('success','Ruta Eliminada Exitosamente');
    }    


    public function rutaOrden($id)
    {
        $ruta = Ruta::find($id);
        return view('configuracion.ruta.orden.index', compact('ruta'));              
    }   

    public function rutaOrdenCreate($id)
    {
        $ruta = Ruta::find($id);
        $types = Type::all();
        $dependencias = Dependencia::all();
        return view('configuracion.ruta.orden.create', compact('ruta', 'types','dependencias'));             
    }    
    public function rutaOrdenStore(Request $request)
    {

        $ruta = Ruta::find($request->ruta);


        $ruta->dependencias()->attach($request->dependencia,['type_id'=> $request->type, 'dias'=> $request->dias] );
     
        // $ruta = Ruta::find($id);
        // $types = Type::all();
        // $dependencias = Dependencia::all();
        // return view('configuracion.ruta.orden.create', compact('ruta', 'types','dependencias'));             

        return redirect()->route('ruta.orden', $ruta->id)
                        ->with('success','Ruta creada Exitosamente');           

    }
}
