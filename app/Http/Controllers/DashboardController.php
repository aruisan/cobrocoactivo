<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class DashboardController extends Controller
{
    public function  index()
    { 
    	$user = Auth::user();

    		$usuarios = User::where('id','<>',1)->get(); 
        if($user->admin == 1){
    		return view('admin.funcionarios.index', compact('usuarios'));
    	}else{
    		return view('admin.funcionarios.index', compact('usuarios'));
    	}
    }
}
