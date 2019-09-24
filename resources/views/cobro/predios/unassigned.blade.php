@extends('layouts.dashboard')

@section('titulo')
    Funcionarios
@stop
@section('sidebar')
  @include('cobro.predios.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mt-2">
            <h2 class="text-center">Predios 	
          @isset($predios)
    		({{$predios->count()}})
    	@endisset</h2>
    </div>
</div>
    
	<div class="container-fluid">
		<br>
		<ul class="nav nav-tabs">
		  <li role="presentation"><a href="{{url('predios')}}">Predios</a></li>
		  <li role="presentation" class="active"><a href="{{route('unnassigned')}}">Predios sin Asignar</a></li>
		  <li role="presentation"><a href="{{route('assignor')}}">Predios Asignados</a></li> 
		</ul>
		<br>
		
		<form method="post" action="{{route('assignor.store')}}" name="details" >
			{{ csrf_field() }}

			<div style="overflow:scroll;height:400px;width:100%;overflow:auto">
			
				<table class="table table-bordered cell-border table-hover" style="height="800" border="0">
					<thead>
				        <tr class="active">
				            <th class="text-center">Selected</th>
				            <th class="text-center">FICHA CATASTRAL</th>
				            <th class="text-center">MATRICULA INMOBILARIA</th>
				            <th class="text-center">Direccion</th>
				            <th class="text-center">Nombre</th>
				        </tr>
				    </thead>

				    <tbody>
				    	@isset($predios)
							@foreach($predios as $predio)
						    	<tr>
						    		<td  class="text-center">
						    			<div class="checkbox checkbox-success"><input type="checkbox" id="checkbox2" name="predios[]" 	value="{{$predio->id}}">
						    			</div
						    		></td>
						    		<td class="text-center">{{$predio->ficha_catastral}}</td>
						    		<td class="text-center">{{$predio->matricula_inmobiliaria}}</td>
						    		<td class="text-center">{{$predio->direccion_predio}}</td>
						    		<td class="text-center">{{$predio->nombre_predio}}</td>
						    	</tr>
							@endforeach
						@endisset
					</tbody>
				</table>
			</div>	
			
			<br>
			@isset ($predios)
				@unless($predios->isEmpty())
					<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">
				    	Asignar
				  	</button>
				@endunless
			@endisset


			<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Asignar Encargado a Predio</h4>
			      </div>
			      <div class="modal-body">
					<div class="row">
						<div class="col-md-4">

							<div class="form-group">
				                {{ Form::label('Usuario', 'Usuario Encargado')}}
				                {{ Form::select('encargado', $usuariosTypeFilt, null, ['placeholder' => 'Selecciona Tipo de usuario', 'id' => 'jefe']) }}                   
				            </div>
						</div>				
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Enviar</button>
			      </div>

			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

		</form>
	</div>
@endsection
