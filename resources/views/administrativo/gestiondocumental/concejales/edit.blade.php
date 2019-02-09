@extends('layouts.dashboard')
@section('titulo')
    Concejal
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/concejales') }}"><span class="hide-menu">CONCEJALES</span></a></li>
    <br>
    <h3 class="text-center">Número de Identificación</h3>
    <br>
    <h4 class="text-center">{{ $datos->num_dc }}</h4>
    <hr>
    <br>
    <h3 class="text-center">Persona de tipo:</h3>
    <br>
    <h4 class="text-center">{{ $datos->tipo }}</h4>
    <hr>
    <div class="row text-center">
        <form action="{{ asset('/dashboard/concejales/'.$concejal->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar Concejal</button>
        </form>
    </div>
    <hr>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb text-center">
        <h2> {{ $datos->nombre }}</h2>
    </div>
    &nbsp;
    <br>
    <div class="col-lg-12 margin-tb text-center">
        <img src="{{ asset('img/concejales/'.$datos->num_dc.'.png')}}" class="card-img-top" width="15%">
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <h2>Editar Información</h2>
    <hr>
    <form action="{{ asset('/dashboard/concejales/'.$concejal->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Partido: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                    <input type="text" name="partido" class="form-control" required value="{{ $concejal->partido }}">
                </div>
                <small class="form-text text-muted">Partido politico del concejal</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Periodo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="text" name="periodo" class="form-control" required value="{{ $concejal->periodo }}">
                </div>
                <small class="form-text text-muted">Periodo del concejal</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Dirección de Correo Electronico: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></span>
                    <input type="text" name="email" class="form-control" required value="{{ $datos->email }}">
                </div>
                <small class="form-text text-muted">Email del concejal</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Dirección de Residencia: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                    <input type="text" name="direccion" class="form-control" required value="{{ $datos->direccion }}">
                </div>
                <small class="form-text text-muted">Dirección del concejal</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Telefono: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    <input type="number" name="telefono" class="form-control" required value="{{ $datos->telefono }}">
                </div>
                <small class="form-text text-muted">Número de contacto del concejal</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Actualizar Foto del Concejal: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-photo" aria-hidden="true"></i></span>
                    <input type="file" name="file" accept="image/png" class="form-control">
                </div>
                <small class="form-text text-muted">Seleccione la nueva foto para el consejal o si la desea cambiar</small>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
        </div>
    </form>
</div>
@endsection