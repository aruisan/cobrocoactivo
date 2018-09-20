<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class DashboardController extends Controller
{
    public function  index()
    { 
    	
    	if(Auth::user()->type_id > 4){
    		return redirect()->route('contractual.index');
    	}else{
    		return redirect()->route('notificaciones.index');
    	
    	}
    }
}
