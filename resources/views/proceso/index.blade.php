
@extends('adminlte::page')

@section('title', 'CobroCoactivo')

@section('content_header')
    <h1>Procesos</h1>
@stop

@section('content')
	<div class="container-fluid">

		<br>
		<table class="table table-bordered cell-border table-hover" id="example"  data-form="deleteForm">
			 <thead>
		        <tr class="active">
		            <th class="text-center">ficha catastral</th>
		            <th class="text-center">matricula inmovilaria</th>
		            <th class="text-center">expediente</th>
		            <th class="text-center"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></th>
		        </tr>
		    </thead>

		    <tbody>
			@foreach($predios as $predio)
		    	<tr>
		    		<td>{{$predio->ficha_catastral}}</td>
		    		<td>{{$predio->matricula_inmobiliaria}}</td>
		    		<td>{{$predio->expediente}}</td>
		    		<td><a href="{{ url("admin/procesos/$predio->id")}}" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a></td>

		    	</tr>
			@endforeach
			</tbody>
		</table>
	</div>

@stop

