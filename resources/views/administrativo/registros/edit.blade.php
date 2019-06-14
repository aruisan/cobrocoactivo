@extends('layouts.dashboard')
@section('titulo')
    Editar Registro
@stop
@section('sidebar')
    <li>
        <a href="{{route('registros.index')}}" class="btn btn-success">
            <span class="hide-menu"> Registros</span></a>
    </li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h3 class="text-center"> Editar Registro: {{ $registro->objeto }}</h3>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <hr>
    <div class="form-validation">
        <form class="form" action="{{url('/administrativo/registros/'.$registro->id)}}" method="POST">
            {!! method_field('PUT') !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Tercero: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <select class="form-control" name="persona_id">
                            @foreach($personas as $persona)
                                <option value="{{$persona->id}}" @if($persona->id == $registro->persona_id) selected @endif>{{$persona->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Relacionar persona</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Objeto: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <textarea name="objeto" class="form-control">{{ $registro->objeto }}</textarea>
                    </div>
                    <small class="form-text text-muted">Nombre del registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Tipo de Documento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        <select name="tipo_doc" class="form-control" onchange="var obj= document.getElementById('tipo_doc_text');if(this.value=='Otro'){obj.style.display='inline';}else{obj.style.display='none';};">
                            <option value="Contrato" @if($registro->tipo_doc == "Contrato") selected @endif>Contrato</option>
                            <option value="Factura" @if($registro->tipo_doc == "Factura") selected @endif>Factura</option>
                            <option value="Resolución" @if($registro->tipo_doc == "Resolucion") selected @endif>Resolución</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <small class="form-text text-muted">Contrato al que pertenece el registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Nombre del Archivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        @if( $registro->ruta == "")
                            El registro no tiene un archivo asignado
                        @else
                            {{ $registro->ruta }}
                        @endif
                    </div>
                    <small class="form-text text-muted">Nombre del archivo al momento de la creación</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group" style="display: none" id="tipo_doc_text">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="tipo_doc_text" placeholder="Cual Otro?" value="{{ $registro->tipo_doc }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-12 col-lg-12">
                    <label>IVA: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i></span>
                        <input type="number" class="form-control" name="iva" required value="{{ $registro->iva }}">
                    </div>
                    <small class="form-text text-muted">Valor del iva con el que se va a regir el registro</small>
                </div>
            </div>
            <div class="row">
                @if($registro->observacion == "")
                @else
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Observación del Rechazo </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            <textarea disabled class="form-control">{{ $registro->observacion }}</textarea>
                        </div>
                        <small class="form-text text-muted">Observación del rechazo del registro.</small>
                    </div>
                @endif
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <button type="submit" class="btn btn-primary" id="storeRegistro">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection