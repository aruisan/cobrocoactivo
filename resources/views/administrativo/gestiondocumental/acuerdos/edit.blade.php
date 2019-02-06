@extends('layouts.dashboard')
@section('titulo')
    Editar Acuerdo
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Editar Acuerdo</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <hr>
    <form action="{{ asset('/dashboard/acuerdos/'.$Acuerdo->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <input type="hidden" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
        <input type="hidden" name="secretaria_e" value="0">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{$Acuerdo->name}}">
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{$Acuerdo->ff_document}}">
                </div>
                <small class="form-text text-muted">Fecha del Documento</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Estado actual del acuerdo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                        <option value="0" @if($Acuerdo->estado == 0) selected @endif>Pendiente</option>
                        <option value="1" @if($Acuerdo->estado == 1) selected @endif>Aprovado</option>
                        <option value="2" @if($Acuerdo->estado == 2) selected @endif>Rechazado</option>
                        <option value="3" @if($Acuerdo->estado == 3) selected @endif>Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Comisión: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                    <select class="form-control" name="comision_id">
                        @foreach($Comisiones as $comision)
                            <option value="{{$comision->id}}" @if($comision->id == $Acuerdo->comision_id) selected @endif>{{$comision->id}} - {{$comision->name}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Comisión asignada al acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="cc_id" class="form-control" required value="{{$Acuerdo->cc_id}}">
                </div>
                <small class="form-text text-muted">Consecutivo asignado al acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Salida: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_salida" class="form-control" required value="{{$Acuerdo->ff_salida}}">
                </div>
                <small class="form-text text-muted">Fecha de salida del acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de 1er debate: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_primerdbt" class="form-control" required value="{{$Acuerdo->ff_primerdbte}}">
                </div>
                <small class="form-text text-muted">Fecha del primer debate</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del 2do debate: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_segundodbt" class="form-control" required value="{{$Acuerdo->ff_segundodbte}}">
                </div>
                <small class="form-text text-muted">Fecha del segundo debate</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Aproibación: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_aprobacion" class="form-control" required value="{{$Acuerdo->ff_aprobacion}}">
                </div>
                <small class="form-text text-muted">Fecha de sanción</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Sanción: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_sancion" class="form-control" required value="{{$Acuerdo->ff_sancion}}">
                </div>
                <small class="form-text text-muted">Fecha de sanción</small>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="{{Storage::url($Acuerdo->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
            <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
        </div>
    </form>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <form action="{{ asset('/dashboard/acuerdos/'.$Acuerdo->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
        </form>
    </div>

</div>
@endsection