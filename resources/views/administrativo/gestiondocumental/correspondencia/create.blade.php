@extends('layouts.dashboard')
@section('sidebar')
    <li><a href="{{ route('correspondencia.index') }}" class="btn btn-primary">Correspondencias</a></li>
@stop
@section('content')


<div class="col-12 formularioCorrespondencia">
    <div class="row">
        <br>
        <div class="col-lg-12 ">
            <h2 class="text-center"> Creación de Correspondencia de {{ $tipo }}</h2>
        </div>
    </div>

    
     <div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
         
        <br>
        <hr>
        {!! Form::open(array('route' => 'correspondencia.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
       
       
        <input type="hidden" name="tipo_doc" value="{{ $id }}">
        <input type="hidden" name="id_resp" value="{{ $idResp }}">
        <div class="row">
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar a la correspondencia</small>
            </div>
      
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Fecha de la Correspondencia: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required>
                </div>
                <small class="form-text text-muted">Fecha de la correspondencia</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="cc_id" class="form-control" required>
                </div>
                <small class="form-text text-muted">Consecutivo asignado a la correspondencia</small>
            </div>
        

        <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Fecha de Aprobación: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_aprobacion" class="form-control" required>
                </div>
                <small class="form-text text-muted">Fecha de la aprobación de la correspondencia</small>
            </div>
        </div>
        @if( $id == 0)


            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Número de correspondencia: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        <input type="number" name="num_doc" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Número asignado a la correspondencia</small>
                </div>
            
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Fecha de Vencimiento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_vence" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Fecha de vencimiento de la correspondencia</small>
                </div>
            </div>
        @endif
    
      <div class="row">
      
       <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Estado actual de la correspondencia: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                        <option value="0">Pendiente</option>
                        <option value="1">Aprovado</option>
                        <option value="2">Rechazado</option>
                        <option value="3">Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra la correspondencia</small>
            </div>
     
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Fecha de Salida: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_salida" class="form-control" required>
                </div>
                <small class="form-text text-muted">Fecha de Salida de la Correspondencia</small>
            </div>
      
        </div>
        
        <div class="row">
    
     <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Tercero: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="tercero">
                        @foreach($terceros as $tercero)
                            <option value="{{$tercero->id}}">{{$tercero->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Relacionar persona a la correspondencia</small>
            </div>
      
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Respuesta: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="respuesta" required>
                </div>
                <small class="form-text text-muted">Respuesta de la correspondencia</small>
            </div>
        </div>
        @if( $id == 0)
            <div class="row">
              <div class="form-group col-xs-11 col-sm-11 col-md-12 col-lg-12"> 
                    <label>Subir Archivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                        <input type="file" name="fileCorrespondenciaE" accept="application/pdf" class="form-control">
                    </div>
                    <small class="form-text text-muted">Archivo de la correspondencia</small>
                </div>
            </div>
        @else
            <div class="row">
                 <div class="form-group col-xs-11 col-sm-11 col-md-12 col-lg-12"> 
                    <label>Subir Archivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                        <input type="file" name="fileCorrespondenciaS" accept="application/pdf" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Archivo de la correspondencia</small>
                </div>
            </div>
        @endif
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
        </div>
        {!! Form::close() !!}
    </div>
      </div>
@stop