@extends('layouts.dashboard')
@section('titulo')
    Editar Roles
@stop

@section('sidebar')
  @include('admin.roles.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Editar Rol</h2>
    </div>
</div>

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <center><h3>Permisos:</h3></center>
            <br/>
            @foreach ($modulos->chunk(4) as $chunk)
            <hr>
            <div class="row">
                @foreach($chunk as $modulo)
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="panel">
                        <div class="panel-body">
                            <label>{{ Form::checkbox('modulo[]', $modulo->id, false, array('class' => 'modulo', 'id' => $modulo->name)) }}
                                {{ $modulo->name }}</label><br>
                            @foreach($modulo->permisos as $value)
                                <label class="permisos">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => $modulo->name, 'id')) }}
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
        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
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
        $(document).ready(function(){
            @foreach($modulos as $modulo)
                var contador=0;
 
                // Recorremos todos los checkbox para contar los que estan seleccionados
                $('.{{$modulo->name}}').each(function(){
                    if($(this).is(":checked"))
                        contador++;
                });

                if(contador == {{ $modulo->permisos->count() }}){
                    $('#{{$modulo->name}}').attr('checked', true);
                }
                
            @endforeach
            
            
        });

        $('.modulo').on('change', function(){
            $( "."+this.id ).prop('checked', $(this).prop("checked"));
        });
    </script>
@endsection