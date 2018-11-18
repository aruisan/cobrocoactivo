<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Dependencia;

class DependenciasController extends Controller
{
	 function __construct()
    {
         $this->middleware('permission:dependencia-list');
    }

    public function index()
    {
        $dependencias = Dependencia::all();

        //return view('admin.dependencias.index', compact('dependencias'));
        return view('admin.dependencias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data = Dependencia::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$name = $request->name;
    	$count = count($name);
        for($i = 0; $i < $count; $i++){	        
	        $store = Dependencia::firstOrCreate(['name' => $name[$i]]);
	    }

        return  redirect()->route('dependencias.index')
        				->with('success','Dependencia Creada Exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependencia = Dependencia::findOrFail($id);
        return view('admin.dependencias.show', compact('dependencia'));

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
    	$count = count($request['datos']);
        for($i = 0; $i < $count; $i++){	        
    		if($request['datos'][$i]['id'] == $id){
        		Dependencia::find($request['datos'][$i]['id'])->update(['name' => $request['datos'][$i]['name']]);
    		}

	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Dependencia::find($id);

        if($destroy->subProyectos->count() > 0  || $destroy->users->count() > 0)
        {
        	return 'Se encontraron '.$destroy->subProyectos->count().' subproyectos y '.$destroy->users->count().' Usuarios con Dependencias';
        }   
        $destroy->delete();
        return 0;
    }
}
