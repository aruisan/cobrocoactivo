@extends('layouts.dashboard')
@section('titulo')
    Crear Modulos
@stop
@section('sidebar')
  @include('admin.modulos.cuerpo.aside')
   @include('admin.permisos.cuerpo.aside')
@stop
@section('content')

<div class="col-12 formularioFuncionarios">


        <div class="row">
            <div class="col-9 margin-tb">
                    <h2 class="text-center">Creación nuevo Modulo</h2>
            </div>
        </div>
      
{!! Form::open(array('route' => 'modulos.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Escriba el nombre de modulo','class' => 'form-control')) !!}
        </div>
    </div>

   <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                                <strong>Categoria:</strong>
                      {!! Form::select('id', $tabs, null, array('class' => 'form-control',
                        'name'=>'tabs')) !!}
                    </div>
                </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
         </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
