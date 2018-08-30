<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Cobro\UserBoss;
use App\Model\Cobro\Type;
use Spatie\Permission\Models\Role;
use App\Model\Permiso;
use DB;
use Hash;


class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:funcionario-list');
         $this->middleware('permission:funcionario-create', ['only' => ['create','store']]);
         $this->middleware('permission:funcionario-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:funcionario-delete', ['only' => ['destroy']]);
    }




    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.funcionarios.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$tipos =  Type::pluck('nombre', 'id');
        $roles =  Role::pluck('name','name')->all();
        return view('admin.funcionarios.create',compact('roles', 'tipos'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if($request->jefe)
        {
            $jefe = new UserBoss;
            $jefe->user_id = $usuario->id;
            $jefe->boss_id = $request->jefe;
            $jefe->save();
        }

        return redirect()->route('funcionarios.index')
                        ->with('success','Usuario Creado Exitosamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.funcionarios.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $tipos =  Type::pluck('nombre', 'id');
        $userRole = $user->roles->pluck('name')->all();


        return view('admin.funcionarios.edit',compact('user','roles','userRole', 'tipos'));
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
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();

        //verificacion de password vacio
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        //se llama al user
        $user = User::find($id);
        //se actualiza el user
        $user->update($input);
        //borran los roles
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        //crean los nuevos roles
        $user->assignRole($request->input('roles'));
        


        //verificacion de jefe vacio
        if($request->jefe && $user->user_boss)
        {
            $jefe = UserBoss::find($user->user_boss->id);
            $jefe->boss_id = $request->jefe;
            $jefe->save();
        }elseif($request->jefe)
        {
            $jefe = new UserBoss;
            $jefe->user_id = $user->id;
            $jefe->boss_id = $request->jefe;
            $jefe->save();
        }


        return redirect()->route('funcionarios.index')
                        ->with('success','Usuario Actualizado Satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('funcionarios.index')
                        ->with('error','Usuario borrado Satisfactoriamente');
    }



    public function jefe($tipo)
    {
        $type = Type::find($tipo);
        if($type->nombre == "Secretaria")
        {
            $tipo = Type::where('nombre', 'Abogado')->first();
        }
        elseif($type->nombre == "Abogado")
        {
            $tipo = Type::where('nombre', 'Coordinador')->first();
        }
        elseif($type->nombre == "Coordinador")
        {
            $tipo = Type::where('nombre', 'Juez')->first();
        }

        return $funcionarios = User::where('type_id', $tipo->id)->get();

    }
}