@extends('layouts.dashboard')

@section('titulo')
    Personas
@stop

@section('sidebar')
	<li><a href="/pazysalvo/create" class="btn btn-danger">Nu9eva Persona</a></li>
	<li><a href="/pazysalvo/create" class="btn btn-succes">Nu9eva Persona</a></li>
@stop

@section('content')
	Bienvenido ({{Auth::user()->name }})
	<table>
		<thead><th>nombre</th></thead>}
		<tbody><tr><td>carlos</td></tr></tbody>
	</table>
@stop