<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use App\User;
use App\Model\Admin\ModelHasRol;


class RolesController extends Controller
{
    public function index()
	{
		$roles = Role::all(); 
    	return view('admin.roles.index', compact('roles'));
	}

	public function create()
    {   
        $data = new Role;
        return view('admin.roles.create', compact('data')); 
    }

    public function store(Request $request)
    {
    	$store = new Role;
    	$store->name = $request->name;
    	$store->save();

    	return redirect()->route('admin.roles');
    }

    public function edit($id)
    {
    	$data = Role::find($id);
    	return view('admin.roles.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
    	$update = Role::find($id);
    	$update->name = $request->name;
    	$update->save();

    	return redirect()->route('admin.roles');
    }


    public function destroy($id)
    {

        $destroy = Role::find($id);
        $usuarios = ModelHasRol::where('role_id', $destroy->id)->count();

         if($usuarios > 0){
            Session::flash('warning', 'tiene '.$usuarios.' Usuarios Relacionados a este Rol.');
        }else{
            $destroy->delete();
            Session::flash('error','Rol Eliminado correctamente');
        }
    	return back();
    }
}
