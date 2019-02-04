<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Cobro\UserBoss;
use App\Model\Cobro\Type;
use Illuminate\Http\Request;
use App\Http\Requests\editPasswordRequest;

class UserController extends Controller
{
    

    public function index()
    {
        $usuarios = User::where('id','<>',1)->get();      
        
        return view('usuarios.index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $usuario = new User;

            
        $tipos =  Type::pluck('nombre', 'id');

        return view('usuarios.create', compact('usuario' ,'tipos')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $usuario = new User;
        
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->type_id = $request->tipo;
        $usuario->password = bcrypt($request->password);

        if($usuario->save()){

            /* $userBoss = new UserBoss;
             $userBoss->user_id = $usuario->id;
             $userBoss->boss_id = $request->jefe;

             $userBoss->save();*/

            return redirect('/admin/usuarios');

        }else {
            return view('admin/usuarios.create', ['usuario' => $usuario]);
        }
    }

    /**
     * Display the specified resource.
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

        $usuario = User::findOrFail($id);

        $tipos =  Type::pluck('nombre', 'id');

        //$userbos = UserBoss::where('user_id', $id)->first();


        $userstype = User::where('type_id', $usuario->type_id - 1)->pluck('name','id');

        //$jefe = User::where('id' , $userbos->boss_id)->first();

        return view('usuarios.edit', compact('usuario','userstype','tipos'));
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
        
        
        $usuario = User::findOrFail($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->type_id = $request->tipo;
        $usuario->password = bcrypt($request->password);

        if($usuario->save()){

            $userBoss = UserBoss::where('boss_id', $usuario->id )->delete();
            return redirect('/admin/usuarios');

        }else {
            return view('admin/usuarios.create', ['usuario' => $usuario]);
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
        
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect('admin/usuarios');
    }

    public function userstype(Request $request, $id)
    {   
           
        if($request->ajax()){
            $userstype = User::where('type_id', $id - 1)->get();
            return response()->json($userstype);
        }
    }

    public function editPassword(editPasswordRequest $request)
    {
       // dd($request->passwordActual);
       // dd(\Hash::check($request->passwordActual, \Auth::user()->password));
        if(\Hash::check($request->passwordActual, \Auth::user()->password))
        {
            $user = User::find(\Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save(); 
        }else{
            \Session::flash('error','contraseña actual incorrecta');
        }
        return back();
    }

    public function editAvatar(Request $request)
    {
        $ruta = $request->file('avatar')->store('public/avatar');
        $user = User::find(\Auth::user()->id);
        $user->avatar = $ruta;
        $user->save();

        return back();
    }

}
