
@extends('adminlte::page')

@section('title', 'CobroCoactivo')

@section('content_header')
    <h1>Proceso</h1>
@stop

@section('content')
	<div class="container-fluid">

		<br>
		<div class="panel panel-default text-center">
		  <h2>Proceso Predial</h2>	
		  <div class="panel-body">
				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<label for="">Ficha Catastral : </label>			
					</div>

					<div class="col-md-2">
						
		    			<span>{{$predio->ficha_catastral}}</span> <br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<label for="">Matricula : </label>			
					</div>

					<div class="col-md-2">
						
		   				<span>{{$predio->matricula_inmobiliaria}}</span> <br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<label for="">Valor: </label>			
					</div>

					<div class="col-md-2">
						
		   				<span>...</span> <br>
					</div>
				</div>

				<div class="row">
					<h2>Archivos del Proceso </h2>	

					<button type="button" class="btn" data-toggle="modal" data-target="#myModal" 
		    			data-id="{{$predio->id}}" style="background-color:orange;color:white">
			    		Subir Archivo
			    		<span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
		    		</button>

					<br><br>

					<table class="table table-bordered cell-border table-hover" id="example"  data-form="deleteForm">
						 <thead>
					        <tr class="active">
					            <th class="text-center">Archivo</th>
					            <th class="text-center">Fechar del Archivo</th>					    
					        </tr>
					    </thead>

					    <tbody>

						</tbody>
					</table>
				</div>

		  </div>


		</div>
	</div>


{{-- Modal	 --}}

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Asignar Dueño a Predio</h4>
      </div>
      {!! Form::Open(['url' => 'admin/proceso-upload-file', 'method' => 'post' , 'files' => true]) !!}
      <div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	                {{ Form::label('Fecha', 'Fecha')}}
	             	{{ Form::date('ff_documento',\Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Nombre']) }}

	            </div>
			</div>				

		</div>		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{{ Form::label('Archivo', 'Archivo')}}
	             	{{ Form::file('file', NULL, ['class' => 'form-control']) }}

	            </div>
			</div>				

		</div>
			
			{{ Form::hidden('cc_id', $predio->id) }}


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      {!! Form::close()!!}

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





@stop

