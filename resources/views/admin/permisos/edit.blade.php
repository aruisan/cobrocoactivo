@extends('layouts.dashboard')
@section('titulo')
    Editar Permiso
@stop

@section('sidebar')
  @include('admin.modulos.cuerpo.aside')
  @include('admin.permisos.cuerpo.aside')
@stop
@section('content')


<div class="col-12 formularioPermisos">

<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Editar Permiso</h2>
    </div>
</div>

{!! Form::model($permiso, ['method' => 'PATCH','route' => ['permisos.update', $permiso->id]]) !!}
   <div class="row inputCenter" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">

        <div class="row">
           
            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                                <strong>Modulo:</strong>
                        {!! Form::select('modulo_id', $modulo,null, array('class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>


             <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Tipo de Permiso: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado" disabled="true">
                       
                        <option value="create" @if(str_is('*-create', $permiso->name ) == true) selected @endif >Crear</option>
                        <option value="edit" @if(str_is('*-edit', $permiso->name ) == true) selected @endif>Editar</option>
                        <option value="list" @if(str_is('*-list', $permiso->name ) == true) selected @endif>Listar</option>
                        <option value="delete" @if(str_is('*-delete', $permiso->name ) == true) selected @endif>Eliminar</option>
                    </select>
                </div>
              
            </div>

   
        </div>
   
        <div class="row ">

                        <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">

                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Nombre de permiso','class' => 'form-control', 'disabled' => true)) !!}
                            </div>
                    
                        </div>


                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                        <label>Estado actual del permiso: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                <select class="form-control" name="activo">
                                    <option value="0" @if($permiso->activo == 0) selected @endif>Desactivado</option>
                                    <option value="1" @if($permiso->activo == 1) selected @endif>Activado</option>
                    
                                </select>
                            </div>
                        <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el permiso</small>
                    </div>
            </div>

            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
                </div>


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
    
    </script>
@endsection