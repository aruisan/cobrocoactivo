<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Modulo;
use DB;
use App\Model\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
       

        $permisos = Permission::orderBy('name','ASC')->paginate(5);
        return view('admin.permisos.index',compact('permisos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $modulo =  Modulo::orderBy('name','ASC')->pluck('name', 'id');
        
        
        return view('admin.permisos.create',compact('modulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   

        $modulo_id = $request->input('modulo_id');
        $ModulosDB = Modulo::find($modulo_id);
        $name = ($ModulosDB->name).'-'.($request->input('tipo'));    
        $activo = $request->input('activo');

        
        $permisos = Permission::where("name","=",$name)->get();
        $PermisCount = $permisos->count();
       

        if($PermisCount>0){                      
            return 
            redirect()->route('permisos.create')
                            ->with('error','El Permiso no se puede crear, porque ya existe un permiso con ese nombre ');
            }
            
            else{

                    $Permisos = new Permission();
                    $Permisos->name = $name;
                    $Permisos->alias=$request->input('tipo');
                    $Permisos->guard_name='web';
                    $Permisos->activo=$activo;
                    $Permisos->modulo_id=$modulo_id;
                    $Permisos->save();

                
                    return redirect()->route('permisos.index')
                                    ->with('success','Permiso creado satisfactoriamente');
            }
       
   
    }



    /**
     * Display the specified resource.
     *
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
       
        
        $permiso = Permission::find($id);
        $modulo =  Modulo::orderBy('name','ASC')->pluck('name', 'id');
       

        return view('admin.permisos.edit',compact('permiso','modulo'));
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
  

        $permiso = Permission::find($id);
        $permiso->update(['activo' => $request->input('activo')]);


      return  redirect()->route('permisos.index')
                        ->with('success','Permiso actualizado satisfactoriamente');
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

        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permisos.index')
                        ->with('error','Permiso Borrado Satisfactoriamente');
    }
}
