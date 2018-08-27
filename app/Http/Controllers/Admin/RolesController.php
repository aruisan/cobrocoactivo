<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Roles;

class RolesController extends Controller
{
    public function index()
	{
		$roles = Role::all(); 
    	return view('admin.roles.index', compact('roles'));
	}
}
