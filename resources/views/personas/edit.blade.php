@extends('layouts.dashboard')

@section('title', 'CobroCoactivo')

@section('titulo')
    Editar Terceros
@stop

@section('sidebar')
	<li><a href="{{route('personas.index')}}" class="btn btn-success">Listar Terceros</a></li>
	<li><a href="{{route('personas.create')}}" class="btn btn-success">Nuevo Tercero</a></li>
@stop
@section("content")
	<div class="container-fluid">
    	<div class="white">

        	@include('personas.partials._form', ['persona' => $persona, 'route' => ['personas.update', $persona->id], 'method' => 'PATCH'])
    	</div>
    </div>
@endsection