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

    	if($user->type->nombre == "Coordinador")
    	{
    		$tipo = Type::where('nombre', 'Abogado')->first();
    		$funcionarios = User::where('type_id', $tipo->id)->get();

    	}elseif($user->type->nombre == "Abogado")

    	{
    		$tipo = Type::where('nombre', 'Secretaria')->first();
    		Type::pluck('nombre', 'id');
    		$funcionarios = User::where('type_id', $tipo->id)->get();
    	}
        elseif($user->type->nombre == "Juez")
        {
            $tipo = Type::where('nombre', 'Coordinador')->first();
            Type::pluck('nombre', 'id');
            $funcionarios = User::where('type_id', $tipo->id)->get();
        }

    	/*foreach ($user->boss_users as $func) {
    		
    	dd($func->user->type);
    	}*/
    	return view('asignar.index', compact('user', 'funcionarios'));
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
