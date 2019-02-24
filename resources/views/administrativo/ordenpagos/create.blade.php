@extends('layouts.dashboard')
@section('titulo')
    Creación Orden de Pago
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
            <center><h2>Nueva Orden de Pago</h2></center>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-4 align-self-center">
                        <label>Nombre: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <small class="form-text text-muted">Nombre que se desee asignar a la orden de pago</small>
                    </div>
                    <div class="col-md-4 align-self-center">
                        <label>Valor: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                            <input type="number" class="form-control" name="valor" required>
                        </div>
                        <small class="form-text text-muted">Valor de la orden de pago, no puede superar el disponible del registro seleccionado</small>
                    </div>
                    <div class="col-md-4 align-self-center">
                        <label>Registro: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <select class="form-control" name="registro_id">
                                @foreach($Registros as $registro)
                                    <option value="{{$registro->id}}">{{$registro->objeto}} - Disponible: $<?php echo number_format($registro->saldo,0) ?></option>
                                @endforeach
                            </select>
                        </div>
                        <small class="form-text text-muted">Relacionar registro</small>
                    </div>
                    <input type="hidden" class="form-control" name="estado" value="0">
                    <center>
                        <div class="form-group row">
                            <div class="col-lg-12 ml-auto">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </center>
                            </form>
                        </div>
                    </div>
                </div>
    @stop
