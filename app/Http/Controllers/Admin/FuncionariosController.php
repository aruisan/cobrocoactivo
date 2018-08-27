<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Cobro\Type;
use App\Model\Cobro\UserBoss;
use Session;
use Spatie\Permission\Models\Role;
use App\Model\Admin\ModelHasRol;

class FuncionariosController extends Controller
{

	public function index()
	{
		$usuarios = User::where('id','<>',1)->where('active', 1)->get(); 
    	return view('admin.funcionarios.index', compact('usuarios'));
	}

    public function create()
    {   
        $usuario = new User;  
        $tipos =  Type::pluck('nombre', 'id');
        $roles =  Role::pluck('name', 'id');

        return view('admin.funcionarios.create', compact('usuario' ,'tipos', 'roles')); 
    }

    public function store(Request $request)
    {
        //dd($request->all());
        
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->type_id = $request->tipo;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        if($request->jefe)
        {
            $jefe = new UserBoss;
            $jefe->user_id = $usuario->id;
            $jefe->boss_id = $request->jefe;
            $jefe->save();
        }
            return redirect()->route('admin.funcionarios');
            //return view('admin.funcionarios.index', ['usuario' => $usuario]);
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $rolUser = ModelHasRol::where('role_id', $id)->first();
        $tipos =  Type::pluck('nombre', 'id');
        $roles =  Role::pluck('name', 'id');

        return view('admin.funcionarios.edit', compact('usuario', 'tipos', 'roles', 'rolUser'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type_id = $request->tipo;
    if($request->password)
    {
        $user->password = bcrypt($request->password);
    }
        $user->save();


        if($request->jefe && $user->user_boss)
        {
            $jefe = $user->user_boss;
            $jefe->boos_id = $request->jefe;
            $jefe->save();
        }elseif($request->jefe)
        {
            $jefe = new UserBoss;
            $jefe->user_id = $user->id;
            $jefe->boss_id = $request->jefe;
            $jefe->save();
        }

        return redirect()->route('admin.funcionarios');

    }

    public function destroy($id){
        $user = User::find($id);
        $user->active = '0';
        $user->save();

        return redirect()->route('admin.funcionarios');
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
