
@extends('adminlte::page')

@section('title', 'CobroCoactivo')

@section('content_header')
    <h1>Editando Persona</h1>
@stop

@section("content")
	<div class="container-fluid">
    	<div class="white">

        	@include('personas.partials._form', ['persona' => $persona, 'url' => 'admin/personas/'.$persona->id, 'method' => 'PATCH'])
    	</div>
    </div>
@endsection