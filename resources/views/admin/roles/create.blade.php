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
            <strong>Permisos:</strong>
            <br/>
            @foreach($modulos as $modulo)
                <label>{{ Form::checkbox('modulo[]', $modulo->id, false, array('class' => 'modulo', 'id' => $modulo->name)) }}
                    {{ $modulo->name }}</label><br>
                @foreach($modulo->permisos as $value)
                    <label class="permisos">{{ Form::checkbox('permission[]', $value->id, false, array('class' => $modulo->name)) }}
                    {{ $value->alias }}</label>
                <br/>
                @endforeach
                <br>
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
    </style>
@endsection

@section('js')
    <script type="text/javascript">
         $('.modulo').on('change', function(){
            $( "."+this.id ).prop('checked', $(this).prop("checked"));
        });
    </script>
@endsection