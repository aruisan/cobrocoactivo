@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
  @include('administrativo.registros.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Creación de Registro</h2>
    </div>
</div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
            {!! Form::open(array('route' => 'registros.store','method'=>'POST')) !!}
                    
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>FECHA DE EXPEDICION: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="ff_exp">
                        </div>
                        <small class="form-text text-muted">fecha donde se expide la licencia</small>
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>FECHA DE VENCIMIENTO: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="ff_venc">
                        </div>
                        <small class="form-text text-muted">fecha donde vence la licencia</small>
                    </div> 

                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="control-label">Datos persona: </label>
                        <div class="input-group">
                            <input type="hidden" name="persona">
                            <input type="text" class="form-control" id="demandado" data-toggle="modal" data-target="#modal-demandado">
                        </div>
                        <small class="form-text text-muted">relacionar persona</small>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                       <input type="file" name="file">
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

@section('js')
   
@stop