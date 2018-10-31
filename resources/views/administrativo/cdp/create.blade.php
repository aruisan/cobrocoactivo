@extends('layouts.dashboard')
@section('titulo')
    Creación de CDP
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/cdp') }}" class="btn btn-success">
            <span class="hide-menu">CDP'S</span></a>
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
            <center><h2>Nuevo CDP</h2></center>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/cdp')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="nombre">Objeto <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea name="name" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="observacion">Observación<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea name="observacion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}" min="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
                    <input type="hidden" class="form-control" name="saldo" value="0">
                    <input type="hidden" class="form-control" name="valor" value="0">
                    <input type="hidden" class="form-control" name="rubro_id" value="1">
                    <input type="hidden" class="form-control" name="estado" value="0">
                    <input type="hidden" class="form-control" name="dependencia_id" value="{{ $dependencia }}">
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
