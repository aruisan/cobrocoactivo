@extends('layouts.dashboard')
@section('titulo')
    Editar Correspondencia
@stop
@section('sidebar')
    {{-- <li><a href="{{ route('correspondencia.index') }}" class="btn btn-primary">Correspondencias</a></li> --}}
@stop
@section('content')

<div class="col-12 formularioCorrespondencia">
<div class="breadcrumb text-center">
        <strong>
            <h4><b>Modificar Correspondencia</b></h4>
        </strong>
    </div>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link regresar"  href="{{ route('correspondencia.index') }}" >Volver a correspondencia</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " data-toggle="pill" href="#editar">EDITAR</a>
        </li>
    </ul>
  

{{-- style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; " --}}
  <div class="tab-content" >  
  
  <div class="row">
        <br>
        <div class="col-lg-12 margin-tb">
            <h3 class="text-center"> Correspondencia: {{ $CorrespondenciaE->name }}</h3>
        </div>
    </div>
        <div id="editar" class="tab-pane  fade in active">
  <div class="row inputCenter"  >
        <br>
        <hr>
        <form action="{{ asset('/dashboard/correspondencia/'.$CorrespondenciaE->id) }}" method="POST"  class="form" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
            {{ csrf_field() }}
            <input type="hidden" name="tipo_doc" value="{{ $CorrespondenciaE->type }}">


            <div class="row">
                   <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Nombre: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="name" required value="{{ $CorrespondenciaE->name }}">
                    </div>
                    <small class="form-text text-muted">Nombre que se desee asignar a la correspondencia</small>
                </div>
        

                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Fecha de la Correspondencia: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_doc" class="form-control" required value="{{ $CorrespondenciaE->ff_document }}">
                    </div>
                    <small class="form-text text-muted">Fecha de la correspondencia</small>
                </div>
            </div>



            <div class="row">
                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Consecutivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        <input type="number" name="cc_id" class="form-control" required value="{{ $CorrespondenciaE->cc_id }}">
                    </div>
                    <small class="form-text text-muted">Consecutivo asignado a la correspondencia</small>
                </div>
        

                  <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Fecha de Aprobación: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_aprobacion" class="form-control" required value="{{ $CorrespondenciaE->ff_aprobacion }}">
                    </div>
                    <small class="form-text text-muted">Fecha de la aprobación de la correspondencia</small>
                </div>
            </div>

            @if( $CorrespondenciaE->type == "Correspondencia entrada")
                <div class="row">
                      <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Número de correspondencia: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                            <input type="number" name="num_doc" class="form-control" required value="{{ $CorrespondenciaE->number_doc }}">
                        </div>
                        <small class="form-text text-muted">Número asignado a la correspondencia</small>
                    </div>
               

                       <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Fecha de Vencimiento: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="date" name="ff_vence" class="form-control" required value="{{ $CorrespondenciaE->ff_vence }}">
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
                            <option value="0" @if( $CorrespondenciaE->estado == 0) selected @endif>Pendiente</option>
                            <option value="1" @if( $CorrespondenciaE->estado == 1) selected @endif>Aprobado</option>
                            <option value="2" @if( $CorrespondenciaE->estado == 2) selected @endif>Rechazado</option>
                            <option value="3" @if( $CorrespondenciaE->estado == 3) selected @endif>Archivado</option>
                        </select>
                    </div>
                    <small class="form-text text-muted">Seleccionar el estado en el que se encuentra la correspondencia</small>
                </div>
          

                   <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Fecha de Salida: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_salida" class="form-control" value="{{ $CorrespondenciaE->ff_salida}}">
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
                                <option value="{{$tercero->id}}" @if($tercero->id == $CorrespondenciaE->tercero_id) selected @endif>{{$tercero->nombre}}</option>
                            @endforeach
                           
                        </select> 
                    </div>
                    <small class="form-text text-muted">Relacionar persona a la correspondencia</small>
                </div>
 

                   <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                    <label>Respuesta: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="respuesta" required value="{{ $CorrespondenciaE->respuesta}}">
                    </div>
                    <small class="form-text text-muted">Respuesta de la correspondencia</small>
                </div>
            </div>

            <div class="row">

             <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
             </div>

            <div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
                <a href="{{Storage::url($CorrespondenciaE->resource->ruta)}}" title="Ver" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i></a>
               </div>
               <div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
                <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
            </div>
        </form>
        <div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
                <form action="{{ asset('/dashboard/correspondencia/'.$CorrespondenciaE->id) }}" method="post">
                    {!! method_field('DELETE') !!}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
                </form>
         
          </div>
           <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
             </div>
        </div>
    </div>
  </div>
    </div>
</div>



@stop