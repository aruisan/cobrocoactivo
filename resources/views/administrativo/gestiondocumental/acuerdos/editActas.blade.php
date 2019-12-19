@extends('layouts.dashboard')
@section('titulo')
    Editar Acta
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li>
@stop
@section('content')

<div class="col-12 formularioActa">
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Editar Acta</h2>
    </div>
</div>


<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
    <br>
    <hr>
    <form action="{{ asset('/dashboard/acuerdos/actas/'.$Acta->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}



        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{ $Acta->name }}">
                </div>
                <small class="form-text text-muted">Nombre del acta</small>
            </div>

           <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Fecha del Acta: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{ $Acta->ff_document }}">
                </div>
                <small class="form-text text-muted">Fecha del Acta</small>
            </div>
        </div>


        <div class="row">
           <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Comisión: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                    <select class="form-control" name="comision_id">
                        @foreach($Comisiones as $comision)
                            <option value="{{$comision->id}}" @if($comision->id == $Acta->comision_id) selected @endif>{{$comision->id}} - {{$comision->name}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Comisión asignada al acuerdo</small>
            </div>
     
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="cc_id" class="form-control" required value="{{ $Acta->cc_id }}">
                </div>
                <small class="form-text text-muted">Consecutivo asignado al acta</small>
            </div>
        </div>


        <div class="row">
          <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Estado actual del Acta: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                        <option value="0" @if($Acta->estado == 0) selected @endif>Pendiente</option>
                        <option value="1" @if($Acta->estado == 1) selected @endif>Aprobado</option>
                        <option value="2" @if($Acta->estado == 2) selected @endif>Rechazado</option>
                        <option value="3" @if($Acta->estado == 3) selected @endif>Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el acta</small>
            </div>
     
           <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Fecha de Aprobación: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_aprobacion" class="form-control" required value="{{ $Acta->ff_aprobacion }}">
                </div>
                <small class="form-text text-muted">Fecha en la que se aprobó el acta</small>
            </div>
        </div>


        <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <label>Archivo:</label>
            <a href="{{Storage::url($Acta->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
           </div> 
            
             <div class="row">
        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
            <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
        </div>
    </form>
    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
        <form action="{{ asset('/dashboard/acuerdos/actas/'.$Acta->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
        </form>
    </div>
</div>

</div>

</div>
@endsection