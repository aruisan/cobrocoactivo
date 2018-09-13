@extends('layouts.dashboard')
@section('titulo')
    CDP's
@stop
@section('sidebar')
    @include('administrativo.contractual.sideBar')
    <li>
        <a href="{{ url('/administrativo/registros') }}" class="btn btn-success">
            <i class="fa fa-ticket"></i>
            <span class="hide-menu"> Registros</span></a>
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
