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


{!! Form::open(array('route' => 'registros.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <center><h3>Permisos:</h3></center>
            <br/>
            @foreach ($modulos->chunk(3) as $chunk)
            <hr>
            <div class="row">
                @foreach($chunk as $modulo)
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            <label>{{ Form::checkbox('modulo[]', $modulo->id, false, array('class' => 'modulo', 'id' => $modulo->name)) }}
                                {{ $modulo->name }}</label><br>
                            @foreach($modulo->permisos as $value)
                                <label class="permisos">{{ Form::checkbox('permission[]', $value->id, false, array('class' => $modulo->name)) }}
                                {{ $value->alias }}</label>
                            <br/>
                            @endforeach
                            <br>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <hr>
        @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
    </div>
</div>
{!! Form::close() !!}


@endsection