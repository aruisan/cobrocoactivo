@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
  @include('administrativo.marcaherrete.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Editar Marcas y Herretes</h2>
    </div>
</div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
            {!! Form::open(array('route' => ['marcas-herretes.update', $data->id],'method'=>'PUT',  'files' => true)) !!}
                    
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>FECHA DE EXPEDICION: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="ff_exp" value="{{$data->ff_expedicion}}" required="required">
                        </div>
                        <small class="form-text text-muted">fecha donde se expide la licencia</small>
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>FECHA DE VENCIMIENTO: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="ff_venc" value="{{$data->ff_vencimiento}}" required="required">
                        </div>
                        <small class="form-text text-muted">fecha donde vence la licencia</small>
                    </div> 

                </div>
                <div class="row">
                    
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <input type="file" name="file">
                    </div>
                </div>
                <hr>
                <h4 ><b>Datos Persona:</b></h4>
                <div class="row">

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="input-group">
                            <label for="">Numero de Documento</label>
                            <input type="text" class="form-control" name="persona_id" id="aidentificador" data-toggle="modal" data-target="#participante" value="{{$persona->num_dc}}" required="required">
                        </div>
                        <small class="form-text text-muted">relacionar persona</small>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="input-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="persona_nombre" id="anombre" data-toggle="modal" value="{{$persona->nombre}}"" data-target="#participante">
                        </div>
                        <small class="form-text text-muted">relacionar persona</small>
                    </div>                

                </div> 
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
                    </div> 

            {!! Form::close() !!}
        </div>

@endsection


@section('css')
  <style type="text/css">
    .form-group{
        margin-top: 10px;
  
    }
  </style>    
@stop

@section('js')
   <script>
        $('#identificador').change(function(event){
            $('#Nombre').val('');
            $('#Email').val('');
            $('#Direccion').val('');
            $('#Telefono').val('');
            $('#Tipo').val([]);
            $.get("/administrativo/persona-find/"+event.target.value+"", function(response){
                console.log(response);
                $('#Nombre').val(response.nombre);
                $('#Email').val(response.email);
                $('#Tipo').append("<option selected value='"+response.tipo+"'>"+response.tipo+"</option>");
                $('#Direccion').val(response.direccion);
                $('#Telefono').val(response.telefono);
            });
         });   
        
          $("#btnForm").click(function (e) {
              e.preventDefault();
              var nombre = $('#Nombre').val();
              $.ajax({
                type: "POST",
                url: "/administrativo/persona/find-create",
                data: $("#myForm").serialize(), 
                success: function (response) {
                    
                    $('#aidentificador').val(response.num_dc);
                    $('#anombre').val(response.nombre);
                }
              });
            $('#participante').modal('hide');
          });
   </script>
@stop