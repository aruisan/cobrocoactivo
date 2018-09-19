@extends('layouts.dashboard')
@section('titulo')
    CDP's
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/cdp/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu"> Crear CDP</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/registros') }}" class="btn btn-primary">
            <span class="hide-menu">Registros</span></a>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/almacen') }}" class="btn btn-primary">
            <i class="fa fa-inventory"></i>
            <span class="hide-menu">Almacen</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>CDP's</h2></center>
            <br>
        </div>
    </div>
    @stop
