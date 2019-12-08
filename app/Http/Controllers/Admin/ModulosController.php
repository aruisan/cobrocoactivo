<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Modulo;
use App\TabsPermission;
use App\Model\Permission;


class ModulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $modulos = Modulo::orderBy('name','ASC')->paginate(5);
        return view('admin.modulos.index',compact('modulos'))
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
        $tabs =  TabsPermission::orderBy('id','ASC')->pluck('nombre', 'id');
        return view('admin.modulos.create',compact('tabs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:modulos,name',
           
        ]);
        
   

        $name = $request->input('name');
        $tabs = $request->input('tabs');

        $Modulos = new Modulo();
        $Modulos->name = $name;
        $Modulos->tabs_permission_id= $tabs;
      
        $Modulos->save();

        // $modulo = Modulo::create(['name' => $request->input('name')],['tabs_permission_id' => $request->input('tabs')]);
       
        return redirect()->route('modulos.index')
                        ->with('success','Modulo creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $modulo = Modulo::find($id);
      

        // return view('admin.modulos.show',compact('modulo'));
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

        $modulo = Modulo::find($id);
        $tabs =  TabsPermission::all();
        return view('admin.modulos.edit',compact('modulo','tabs'));



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
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $Modulos = Modulo::find($id);
                $name = $request->input('name');

                $moduloNombre = Modulo::where("name","=",$name)
                ->where("id",'!=',$id)->get();
                $ModulCount = $moduloNombre->count();


                $permisos = Permission::where("modulo_id","=",$id)->get();
                $PermisCount = $permisos->count();
               
                if($ModulCount<=0){   
                              
                            if($PermisCount>0){                      
                                return 
                                redirect()->route('modulos.index')
                                                ->with('error','El Modulo no se puede editar, porque existen permisos '.$PermisCount.' asociados');
                                }
                
                            else{  
                                    $Modulos = Modulo::findOrFail($id);
                                    $name = $request->input('name');
                                    $tabs = $request->input('tabs');

                                    $Modulos->name = $name;
                                    $Modulos->tabs_permission_id = $tabs;
                                    $Modulos->save();

                                    return redirect()->route('modulos.index')
                                            ->with('success','Modulo actualizado satisfactoriamente');
                        
                            }

                   }
            else{
                return 
                redirect()->route('modulos.index')
                                ->with('error','El Modulo no se puede editar, porque existe otro modulo con el mismo nombre');
          
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

        $permisos = Permission::where("modulo_id","=",$id)->get();
        $PermisCount = $permisos->count();
       

        if($PermisCount>0){
          
        return 
        redirect()->route('modulos.index')
                        ->with('error','El Modulo no se puede borrar, porque existen permisos '.$PermisCount.' asociados');
        }else{
              
            DB::table("modulos")->where('id',$id)->delete();
                    return redirect()->route('modulos.index')
                                    ->with('error','Modulo Borrado Satisfactoriamente');
        }
     
    }
}
