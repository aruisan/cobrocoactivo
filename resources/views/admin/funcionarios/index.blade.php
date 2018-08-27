
@extends('layouts.dashboard')
@section('titulo')
    Funcionarios
@stop

@section('sidebar')
	<li><a href="{{url('admin/funcionarios/create')}}" class="btn btn-success"><i class="material-icons md-18">account_box</i> Nuevo Funcionario</a></li>
	<li class="dropdown">
    	<a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
        	<i class="fa fa-user fa-fw "></i> 
    			ROLES FUNCIONARIOS
        	<i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
        	<li>
        		<a href="{{url('admin/roles')}}" class="btn btn-primary"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
        		<a href="{{url('admin/roles/create')}}" class="btn btn-primary"><i class="material-icons md-12ss">create</i> Crear</a>
            </li>
        </ul>
    </li>
@stop

@section('content')
@include('alertas.errors')
		<br>
		<div class="table-responsive">
			<table class="table table-bordered cell-border table-hover" id="example"  data-form="deleteForm">
				 <thead>
			            <th class="text-center">ID</th>
			            <th class="text-center">Nombre</th>
			            <th class="text-center">Email</th>
			            <th class="text-center">Tipo</th>
			            <th class="text-center">Jefe</th>
			            <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
			            <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
			    </thead>
			    <tbody>
				@foreach($usuarios as $usuario)
			    	<tr>
			    		<td class="text-center">{{$usuario->id}}</td>
			    		<td class="text-center">{{$usuario->name}}</td>
			    		<td class="text-center">{{$usuario->email}}</td>
			    		<td class="text-center">@if($usuario->type) {{$usuario->type->nombre}} @endif</td>
			    		<td class="text-center">@if($usuario->user_boss) {{$usuario->user_boss->boss->name}} @endif</td>
			    		<td class="text-center">
			    			<a href="{{url("admin/funcionarios/".$usuario->id."/edit")}}" class="btn btn-xs btn-info">
			    				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			    			</a>
			    		</td>
			    		<td class="text-center">
			    		    @include('admin.funcionarios.delete', ['usuario' => $usuario])
			    		</td>
			    	</tr>
				@endforeach
				</tbody>
			</table>
	</div>
@stop
@section('js')
   <script>
		$(document).ready(function() {
		    $('#example').DataTable();
		} );
   </script>
@stop
