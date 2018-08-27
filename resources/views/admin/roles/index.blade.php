
@extends('layouts.dashboard')
@section('titulo')
    Funcionarios
@stop

@section('sidebar')
	<li><a href="{{url('admin/roles/create')}}" class="btn btn-success"><i class="fa fa-user fa-fw "></i> Nuevo Rol</a></li>
	<li class="dropdown">
    	<a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
        	<i class="material-icons md-18">account_box</i> 
    		Funcionarios
        	<i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
        	<li>
        		<a href="{{url('admin/funcionarios')}}" class="btn btn-primary"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
        		<a href="{{url('admin/funcionarios/create')}}" class="btn btn-primary"><i class="material-icons md-12ss">create</i> Crear</a>
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
			            <th class="text-center">Rol</th>
			            <th class="text-center"><i class="fa fa-sitemap" aria-hidden="true"></i></th>
			            <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
			            <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
			    </thead>
			    <tbody>
				@foreach($roles as $rol)
			    	<tr>
			    		<td class="text-center">{{$rol->id}}</td>
			    		<td class="text-center">{{$rol->name}}</td>
			    		<td class="text-center">
			    			<a href="{{url("admin/roles/".$rol->id)}}" class="btn btn-xs btn-warning">
			    				<i class="fa fa-sitemap" aria-hidden="true"></i>
			    			</a>
			    		</td>
			    		<td class="text-center">
			    			<a href="{{url("admin/roles/".$rol->id."/edit")}}" class="btn btn-xs btn-info">
			    				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			    			</a>
			    		</td>
			    		<td class="text-center">
			    		    @include('admin.roles.delete', ['usuario' => $rol])
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
