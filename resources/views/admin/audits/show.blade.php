@extends('layouts.dashboard')
@section('titulo')
    Información del Movimiento
@stop
@section('sidebar')
    <li> <a href="{{ url('admin/audits') }}" class="btn btn-success"><span class="hide-menu">&nbsp; Logs</span></a></li>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if($auditoria->event == "created" )
            <h2 class="text-center"> Informació del Registro Creado</h2>
            @elseif($auditoria->event == "updated")
                <h2 class="text-center"> Información del Registro Actualizado</h2>
            @elseif($auditoria->event == "deleted")
                <h2 class="text-center"> Información del Registro Eliminado</h2>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
        <hr>
        <form action=""  class="form" enctype="multipart/form-data">
            @if($auditoria->event == "created" )
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Usuario Responsable: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" disabled value="{{$auditoria->user->name}}">
                    </div>
                    <small class="form-text text-muted">Usuario Responsable de la Creación</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>URL: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edge" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" disabled value="{{$auditoria->url}}">
                    </div>
                    <small class="form-text text-muted">Url en la que se realizo el movimiento</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Dirección IP: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" disabled value="{{$auditoria->ip_address}}">
                    </div>
                    <small class="form-text text-muted">Direcciñon IP desde la que se realizó el movimiento</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Fecha: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" disabled value="{{$auditoria->created_at}}">
                    </div>
                    <small class="form-text text-muted">Fecha y hora en la que se realizó el movimiento</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Registro: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                        <textarea class="form-control" disabled>{{$auditoria->new_values}}</textarea>
                    </div>
                    <small class="form-text text-muted">Todo la información referente a el nuevo registro</small>
                </div>
            </div>
            @elseif($auditoria->event == "updated")
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Usuario Responsable: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->user->name}}">
                        </div>
                        <small class="form-text text-muted">Usuario Responsable de la Creación</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>URL: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-edge" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->url}}">
                        </div>
                        <small class="form-text text-muted">Url en la que se realizo el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Dirección IP: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->ip_address}}">
                        </div>
                        <small class="form-text text-muted">Direcciñon IP desde la que se realizó el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Fecha: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->created_at}}">
                        </div>
                        <small class="form-text text-muted">Fecha y hora en la que se realizó el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Información Antigua del Registro: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <textarea class="form-control" disabled>{{$auditoria->old_values}}</textarea>
                        </div>
                        <small class="form-text text-muted">Todo la información referente al registro</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Información Nueva del Registro: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <textarea class="form-control" disabled>{{$auditoria->new_values}}</textarea>
                        </div>
                        <small class="form-text text-muted">Todo la información referente al registro</small>
                    </div>
                </div>
            @elseif($auditoria->event == "deleted")
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Usuario Responsable: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->user->name}}">
                        </div>
                        <small class="form-text text-muted">Usuario Responsable de la Creación</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>URL: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-edge" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->url}}">
                        </div>
                        <small class="form-text text-muted">Url en la que se realizo el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Dirección IP: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->ip_address}}">
                        </div>
                        <small class="form-text text-muted">Direcciñon IP desde la que se realizó el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Fecha: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" disabled value="{{$auditoria->created_at}}">
                        </div>
                        <small class="form-text text-muted">Fecha y hora en la que se realizó el movimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Información del Registro Eliminado: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <textarea class="form-control" disabled>{{$auditoria->old_values}}</textarea>
                        </div>
                        <small class="form-text text-muted">Todo la información referente al registro elimiando</small>
                    </div>
                </div>
            @endif
        </form>
    </div>
    @stop
