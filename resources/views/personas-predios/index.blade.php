@extends('layouts.dashboard')

@section('titulo')
    Funcionarios
@stop
@section('sidebar')
  @include('cobro.predios.cuerpo.aside')
@stop
@section('content')
    
	<div class="container-fluid">
				<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" 
		    			data-id="{{$predio->id}}">
		    		Ingresar Dueños al Predio
		    		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		    	</button>

		<ul class="nav nav-tabs">
			<li role="presentation"><a href="{{url('predios')}}">Predios</a></li>
		  <li role="presentation" class="active"><a href="">Asignar personas a predio</a></li>
{{-- 		  <li role="presentation"><a href="{{route('unnassigned')}}">Predios sin Asignar</a></li>
		  <li role="presentation"><a href="{{route('assignor')}}">Predios Asignados</a></li>  --}}
		</ul>
		<br>

		<div class="col-md-offset-2 col-md-6 mt-2">
			<table class="table table-bordered cell-border table-hover">
			    <tbody>
					<tr>
						<td><b>Matricula Inmoviliaria: </b></td>
						<td>{{$predio->matricula_inmobiliaria}}</td>
					</tr>
					<tr>
						<td><b>Dirección Predio: </b></td>
						<td>{{$predio->direccion_predio}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br><br><br>

		<table class="table table-bordered cell-border table-hover">
			<thead>
		        <tr class="active">
		            <th class="text-center">DUEÑOS</th>
		            <th class="text-center">PORCENTAJE</th>
		            <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
		        </tr>
		    </thead>

		    <tbody>
		    	@foreach($predio->personas as $personas)
		    		<tr>
		    			<td>{{ $personas->nombre }}</td>
		    			<td>{{ $personas->pivot->porcentaje }}</td>
		    			<td>	
		    				@include('personas-predios.delete', ['personas' => $personas ])
						</td>
		    		
		    		</tr>
		    	@endforeach
			</tbody>
		</table>
	</div>

{{-- modal	 --}}

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Asignar Dueño a Predio</h4>
      </div>
      {!! Form::Open(['url' => 'predio-asignar', 'method' => 'post']) !!}
      <div class="modal-body" style="display: flex">
		<div class="row">
			<div class="col-md-4">

				{{ Form::hidden('persona_id', NULL , ['id' => 'apersonaid']) }}
				{{ Form::hidden('predio_id', NULL , ['id' => 'apredioid']) }}

				<div class="form-group">
	                {{ Form::label('num_dc', 'Numero Documento')}}
	             	{{ Form::text('porcentaje', NULL, ['class' => 'form-control', 'placeholder' => 'Numero Documento',
	             	 'id' => 'aidentificador','onClick' => 'myFunction()']) }}

	            </div>
			</div>				
			<div class="col-md-4">
				<div class="form-group">
	                {{ Form::label('nombre', 'Nombre')}}
	             	{{ Form::text('porcentaje', NULL, ['class' => 'form-control', 'placeholder' => 'Nombre',
	             	 'id' => 'anombre']) }}

	            </div>
			</div>			
			<div class="col-md-4">
				<div class="form-group">
	                {{ Form::label('porcentaje', 'Porcentaje %')}}
	                {{ Form::text('porcentaje', NULL, ['class' => 'form-control', 'placeholder' => 'Porcentaje']) }}
	            </div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      {!! Form::close()!!}

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- modal1	 --}}

<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Buscar o Crear Dueño</h4>
      </div>
      {!! Form::Open(['url' => 'admin/find-create', 'method' => 'POST' , 'id' => 'myForm']) !!}
      <div class="modal-body" style="display: inline-block;">
			<div class="row">
				<div class="col-md-4">
		            <div class="form-group">
	    	            {{ Form::label('Numero Documento', 'Numero Documento')}}
	        	        {{ Form::text('num_dc', NULL, ['class' => 'form-control', 'id'=>'identificador', 'placeholder' => 'Numero Documento']) }}
	            	</div>
				</div>			
				<div class="col-md-4">
					
			        <div class="form-group">
		                {{ Form::label('Nombre', 'Nombre')}}
		                {{ Form::text('nombre', Null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'id' => 'Nombre']) }}
			        </div>

				</div>			
				<div class="col-md-4">
	            	<div class="form-group">
	                	{{ Form::label('Email', 'Email')}}
	                	{{ Form::text('email', NULL, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'Email']) }}            
	           		 </div>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-4">
				    <div class="form-group">
	                	{{ Form::label('Tipo', 'Tipo')}}
	                	{{ Form::select('tipo', ['NATURAL'=> 'NATURAL', 'JURIDICA' =>'JURIDICA'], 'NATURAL', ['class' => 'form-control', 'id' => 'Tipo'] ) }}            
	            	</div>
				</div>			
				<div class="col-md-4">
			       <div class="form-group">
	                	{{ Form::label('Direccion', 'Direccion')}}
	                	{{ Form::text('direccion', NULL, ['class' => 'form-control', 'placeholder' => 'Direccion', 'id' => 'Direccion']) }}     
	           		</div>

				</div>			
				<div class="col-md-4">
	                <div class="form-group">
	                	{{ Form::label('Telefono', 'Telefono')}}
	                	{{ Form::text('telefono', Null, ['class' => 'form-control', 'placeholder' => 'Telefono', 'id' => 'Telefono']) }}            
	            	</div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id ="btnForm" class="btn btn-primary">relacionar</button>
      </div>
	  {!! Form::close()!!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('js')
   <script>
		$(document).ready(function() {
		    $('#example').DataTable();
		} );

		$('#myModal').on('shown.bs.modal', function (e) {
			var predioId = $(e.relatedTarget).data('id')
			$("#apredioid").val(predioId);
		})

		function myFunction(){
			$('#myModal2').modal('show')
		}		

        $('#identificador').change(function(event){
            $.get("/persona-find/"+event.target.value+"", function(response){
                console.log(response);
                if(response != '')
                {
	                $('#Nombre').val(response.nombre);
	                $('#Email').val(response.email);
	                $('#Tipo').empty()
	                	if(response.tipo == "NATURAL")
	                	{
	                		$('#Tipo').append("<option selected value='"+response.tipo+"'>"+response.tipo+"</option><option value='JURIDICA'>JURIDICA</option>");
	                	}else if(response.tipo == "JURIDICA")
	                	{
	                		$('#Tipo').append("<option selected value='"+response.tipo+"'>"+response.tipo+"</option><option value='NATURAL'>NATURAL</option>");
	                	}else{
	                		$('#Tipo').append("</option><option selected value='NATURAL'>NATURAL</option></option><option value='JURIDICA'>JURIDICA</option>");
	                	}
	                $('#Direccion').val(response.direccion);
	                $('#Telefono').val(response.telefono);
            	}
            });

         });   

        
		  $("#btnForm").click(function (e) {
		      e.preventDefault();
		      var nombre = $('#Nombre').val();
		      console.log($("#myForm").serialize());
		      $.ajax({
			    type: "POST",
		        url: "/persona/find-create",
		        data: $("#myForm").serialize(), 
		        success: function (response) {
		             console.log(response);
		            $('#apersonaid').val(response.id);
		            $('#aidentificador').val(response.num_dc);
		            $('#anombre').val(response.nombre);
		        }
		      });

		    $('#myModal2').modal('hide');

		  });
   </script>
@stop
		         
