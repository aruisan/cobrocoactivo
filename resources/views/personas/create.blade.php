
@extends('layouts.dashboard')

@section('title', 'CobroCoactivo')

@section('titulo')
    Creacion de personas
@stop

@section('sidebar')
	<li><a href="{{url('admin/personas/create')}}" class="btn btn-success">Nuevo Funcionario</a></li>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 @include('personas.partials._form', ['persona' => $persona, 'url' => 'admin/personas', 'method' => 'POST'])
			</div>
		</div>
	</div>
@stop

