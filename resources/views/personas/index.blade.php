
@extends('layouts.dashboard')

@section('title', 'CobroCoactivo')

@section('titulo')
    Personas
@stop

@section('sidebar')
	<li><a href="{{url('admin/personas/create')}}" class="btn btn-success">Nuevo Funcionario</a></li>
@stop

@section('content')
	<div class="container-fluid">
		<br>
		<table class="table table-bordered cell-border table-hover" id="example"  data-form="deleteForm">
			 <thead>
		        <tr class="active">
		            <th class="text-center">Nombre</th>
		            <th class="text-center">Numero Documento</th>
		            <th class="text-center">Email</th>
		            <th class="text-center">Direccion</th>
		            <th class="text-center">Tipo</th>
		            <th class="text-center">Telefono</th>
		            <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
		            <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
		        </tr>
		    </thead>

		    <tbody>
			@foreach($personas as $persona)
		    	<tr>
		    		<td>{{$persona->nombre}}</td>
		    		<td>{{$persona->num_dc}}</td>
		    		<td>{{$persona->email}}</td>
		    		<td>{{$persona->direccion}}</td>
		    		<td>{{$persona->tipo}}</td>
		    		<td>{{$persona->telefono}}</td>
		    		<td><a href="{{ url("admin/personas/".$persona->id."/edit")}}" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
		    		<td>
		    		    @include('personas.delete', ['persona' => $persona])
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
