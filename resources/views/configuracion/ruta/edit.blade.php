@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
  @include('configuracion.ruta.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Editar Rutas</h2>
    </div>
</div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
            {!! Form::open(array('route' => ['rutas.update', $ruta->id],'method'=>'PUT',  'files' => true)) !!}
                    
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Nombre de la Ruta: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="nombre" value="{{$ruta->nombre}}" required="required">
                        </div>
                        <small class="form-text text-muted">Nombre de la ruta</small>
                    </div>

                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
                </div> 

            {!! Form::close() !!}
        </div>

@endsection


@section('css')
  <style type="text/css">
    .form-group{
        margin-top: 10px;
  
    }
  </style>    
@stop
