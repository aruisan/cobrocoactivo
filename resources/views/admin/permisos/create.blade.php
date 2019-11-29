@extends('layouts.dashboard')
@section('titulo')
    Crear Permisos
@stop
@section('sidebar')
  @include('admin.permisos.cuerpo.aside')
@stop
@section('content')

<div class="col-12 formularioFuncionarios">


        <div class="row">
            <div class="col-9 margin-tb">
                    <h2 class="text-center">Creación nuevo Permiso</h2>
            </div>
        </div>
      
{!! Form::open(array('route' => 'permisos.store','method'=>'POST')) !!}
<div class="row">


            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                                <strong>Modulo:</strong>
                        {!! Form::select('modulo_id', $modulo,null, array('class' => 'form-control',
                        'name'=>'modulo_id')) !!}
                    </div>
                </div>


                  <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Tipo de Permiso: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="tipo">
                       
                        <option value="create" >Crear</option>
                        <option value="edit" >Editar</option>
                        <option value="list" >Listar</option>
                        <option value="delete" >Eliminar</option>
                    </select>
                </div>
              
            </div>

   
</div>
   
<div class="row">
               <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Estado actual del permiso: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="activo">
                        <option value="0" >Desactivado</option>
                        <option value="1" >Activado</option>
         
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

@section('js')

<script type="text/javascript">

</script>
@endsection