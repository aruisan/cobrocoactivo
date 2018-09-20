
@extends('adminlte::page')

@section('title', 'CobroCoactivo')

@section('content_header')
    <h1>Editando Predio</h1>
@stop

@section("content")
	<div class="container-fluid">
    	<div class="white">

        	@include('predios.partials._form', ['predio' => $predio, 'url' => 'admin/predios/'.$predio->id, 'method' => 'PATCH'])
    	</div>
    </div>
@endsection