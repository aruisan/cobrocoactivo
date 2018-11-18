
<div id="observacion" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
		    <div class="modal-header">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Relacion de Terceros</h4>
		    </div>
		    <div class="modal-body">
		        {!! Form::Open(['url' => $url, 'method' => $method]) !!}
		            <div class="form-group">
		                {{ Form::label('Nombre', 'Nombre')}}
		                {{ Form::text('nombre', $persona->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
		            </div>
		            <div class="form-group">
		                {{ Form::label('Numero Documento', 'Numero Documento')}}
		                {{ Form::text('num_dc', $persona->num_dc, ['class' => 'form-control', 'placeholder' => 'Numero Documento']) }}
		            </div>
		            <div class="form-group">
		                {{ Form::label('Email', 'Email')}}
		                {{ Form::text('email', $persona->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}            
		            </div>
		            <div class="form-group">
		                {{ Form::label('Tipo', 'Tipo')}}
		                {{ Form::select('tipo', ['NATURAL'=> 'NATURAL', 'JURIDICA' =>'JURIDICA'], $persona->tipo, ['placeholder' => 'Selecciona Tipo de Persona']) }}            
		            </div>
		            <div class="form-group">
		                {{ Form::label('Direccion', 'Direccion')}}
		                {{ Form::text('direccion', $persona->direccion, ['class' => 'form-control', 'placeholder' => 'Direccion']) }}            
		            </div>
		            <div class="form-group">
		                {{ Form::label('Telefono', 'Telefono')}}
		                {{ Form::text('telefono', $persona->telefono, ['class' => 'form-control', 'placeholder' => 'Telefono']) }}            
		            </div>
		            
		            <div class="form-group">
		                <a href="{{ url('admin/personas') }}">Regresar al Listado De Personas</a>
		                <input type="submit" value="enviar" class="btn btn-success">
		            </div>
				{!! Form::close()!!}
		    </div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger">Rechazar Registro</button>
			</div>
	    </div>	
  	</div>
</div>














