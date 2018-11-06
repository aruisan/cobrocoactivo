@extends('layouts.dashboard')
@section('titulo')
    Información del CDP
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/cdp') }}" class="btn btn-success">
            <span class="hide-menu">CDP's</span></a>
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
            <center><h2>Información del CDP: {{ $idcdp->name }}</h2></center>
            <br>
            <div class="form-validation">
                <form class="form" action="{{url('/administrativo/cdp/'.$idcdp->id)}}" method="POST">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="fecha">Fecha:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" disabled style="text-align:center" value="{{ $idcdp->fecha }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Objeto <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea name="name" class="form-control">{{ $idcdp->name }}</textarea>
                                <input type="hidden" class="form-control" name="id" value="{{ $idcdp->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                        <label class="control-label text-right col-md-4" for="fecha">Dependencia:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" disabled style="text-align:center" value="{{ $idcdp->dependencia->name }}">
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="observacion">Observación<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea name="observacion" class="form-control">{{ $idcdp->observacion }}</textarea>
                            </div>
                        </div>
                    </div>
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
