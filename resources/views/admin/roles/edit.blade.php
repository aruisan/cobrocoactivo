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
            <strong>Permisos:</strong>
            <br/>
            @foreach($modulos as $modulo)
                <label>{{ Form::checkbox('modulo[]', $modulo->id, false, array('class' => 'modulo', 'id' => $modulo->name)) }}
                    {{ $modulo->name }}</label><br>
                @foreach($modulo->permisos as $value)
                    <label class="permisos">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => $modulo->name, 'id')) }}
                    {{ $value->alias }}</label>
                <br/>
                @endforeach
                <br>
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