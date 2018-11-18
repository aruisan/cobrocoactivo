
@extends('layouts.dashboard')

@section('title', 'CobroCoactivo')

@section('titulo')
    Creacion de personas
@stop

@section('sidebar')
	<li><a href="{{route('personas.index')}}" class="btn btn-success">Listar Terceros</a></li>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 @include('personas.partials._form', ['persona' => $persona, 'route' => 'personas.store', 'method' => 'POST'])
			</div>
		</div>
	</div>
@stop

