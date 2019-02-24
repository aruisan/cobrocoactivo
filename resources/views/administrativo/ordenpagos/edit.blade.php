@extends('layouts.dashboard')
@section('titulo')
    Editar Orden de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos') }}" class="btn btn-success">
            <span class="hide-menu">Ordenes de Pago</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Información de la Orden de Pago: {{ $ordenPago->nombre }}</h2></center>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    Registro Seleccionado: {{ $ordenPago->registros->objeto }}
                </div>
                <div class="col-md-4 text-center">
                    Saldo del Registro: $<?php echo number_format($ordenPago->registros->saldo,0) ?>
                </div>
                <div class="col-md-4 text-center">
                    Tercero: {{ $ordenPago->registros->persona->nombre }}
                </div>
            </div>
            <div class="form-validation">
                <form class="form" action="{{url('/administrativo/ordenPagos/'.$ordenPago->id)}}" method="POST">
                    <br>
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <label>Nombre: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="nombre" required value="{{ $ordenPago->nombre }}">
                        </div>
                        <small class="form-text text-muted">Nombre que se desee asignar a la orden de pago</small>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <label>Valor: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                            <input type="number" class="form-control" name="valor" required value="{{ $ordenPago->valor  }}">
                        </div>
                        <small class="form-text text-muted">Valor de la orden de pago, no puede superar el disponible del registro seleccionado</small>
                    </div>
                    <br>
                    &nbsp;
                    <br>
                    <center>
                        <div class="form-group row">
                            <div class="col-lg-12 ml-auto">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </center>
                </form>
                <center>
                    <div class="form-group row">
                        <div class="col-lg-12 ml-auto">
                            <form action="{{ asset('/administrativo/ordenPagos/'.$ordenPago->id) }}" method="post">
                                {!! method_field('DELETE') !!}
                                {{ csrf_field() }}
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
    @stop
