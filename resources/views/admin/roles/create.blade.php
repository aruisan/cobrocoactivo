@extends('layouts.dashboard')
@section('titulo')
    Crear Roles
@stop
@section('sidebar')
  @include('admin.roles.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Crear Rol</h2>
    </div>
</div>


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
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
                                {{ $value->name }}</label>
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

@section('css')
    <style type="text/css">
        .permisos{
            margin-left: 15px;
        }

        hr { 
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
         $('.modulo').on('change', function(){
            $( "."+this.id ).prop('checked', $(this).prop("checked"));
        });
    </script>
@endsection