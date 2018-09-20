@extends('layouts.dashboard')

@section('titulo')
    Predios
@stop

@section('sidebar')
	<li><a href="/pazysalvo/create" class="btn btn-primary">Nuevo Paz y Salvo</a></li>
	<li><a href="/pazysalvo/create" class="btn btn-warning">Nuevo Paz y Salvo</a></li>
@stop

@section('content')
	Bienvenido dashboard ({{Auth::user()->name }})
@stop