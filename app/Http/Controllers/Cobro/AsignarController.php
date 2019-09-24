<?php

namespace App\Http\Controllers\Cobro;
use App\User;
use App\Model\Cobro\UserBoss;
use App\Model\Cobro\Type;

use Illuminate\Http\Request;

class AsignarController extends Controller
{
    public function index($id)
    {
    	$user = User::find($id);


    	if($user->type->nombre == "Coordinador CobroCoactivo")
    	{
    		$tipo = Type::where('nombre', 'Abogado CobroCoactivo')->first();
    		$funcionarios = User::where('type_id', $tipo->id)->get();

    	}elseif($user->type->nombre == "Abogado CobroCoactivo")

    	{
    		$tipo = Type::where('nombre', 'Secretaria CobroCoactivo')->first();
    		Type::pluck('nombre', 'id');
    		$funcionarios = User::where('type_id', $tipo->id)->get();
    	}
        elseif($user->type->nombre == "Juez CobroCoactivo")
        {
            $tipo = Type::where('nombre', 'Coordinador CobroCoactivo')->first();
            Type::pluck('nombre', 'id');
            $funcionarios = User::where('type_id', $tipo->id)->get();
        }

        if (isset($funcionarios)) {
            return view('asignar.index', compact('user', 'funcionarios'));
        }
        else{
            return back()->with('error','Este usuario es Secretaria o no es de tipo CobroCoactivo , por lo cual no se puede asignar Empleado');
        }

    }

    public function store(Request $request)
    {
    	$userBoss = new UserBoss;
        $userBoss->user_id = $request->user_id;
        $userBoss->boss_id = $request->boss_id;

        $userBoss->save();
        return back();
    }


    public function destroy($id)
    {
        $usuario = UserBoss::findOrFail($id);
        $usuario->delete();

        return back();
    }
}
