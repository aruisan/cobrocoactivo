@extends('layouts.presupuesto')
@section('contenido')

	<div class="container-fluid" id="crud">
		<div class="row">
			<div class="col-10">
				<div class="card">
        			<form action="{{url('/registro')}}" method="POST"  class="form">
        				@csrf
        				<input type="hidden"   name="level_id" value="{{ $nivel->id }}">
        				<input type="hidden"   name="level" value="{{ $nivel->level }}">
        				<table class="table" id="tabla">
	        				<center>Nivel {{ $nivel->level }} - {{ $nivel->name }}</center><br><br>
		        			<thead>
		        				@if($nivel->level > 1)
		        					<th>Código</th>
			        				<th>Nombre</th>
			        				<th>Relacion</th>
		        				@else
		        					<th>Código</th>
			        				<th>Nombre</th>
		        				@endif
		        			</thead>
		        			<tbody>	
		        				<tr v-for="dato in datos" class="table-primary">
		        					<td><input type="hidden" name="register_id[]" v-model="dato.id"><input type="text" class="form-control" name="code[]" v-model="dato.code" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td>
		        					<td><input type="text" class="form-control" name="nombre[]" v-model="dato.name" required></td>
		        					@if($nivel->level > 1)
		        					<td>
		        						<select name="padre[]" class="form-control">
		        							@foreach($codes as $code)
		        								<option value="{{ $code->id }}" :selected="dato.register_id == <?= $code->id; ?> ? true : false">{{ $code->code }} {{ $code->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					@endif
		        					<td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
		        				</tr>		
		        				@for ($i = 0; $i < $fila; $i++)
		        					<tr>
		        						<td><input type="hidden" name="register_id[]"><input type="text" class="form-control" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td>
		        						<td><input type="text" class="form-control" name="nombre[]" required></td>
		        						@if($nivel->level > 1)
		        						<td>
		        						<select name="padre[]" class="form-control">
		        							@foreach($codes as $code)
		        								<option value="{{ $code->id }}">{{ $code->id }} - {{ $code->name }}</option>
		        							@endforeach
		        						</select>
		        						</td>
		        						@endif
		        						<td><input type="button" class="borrar btn btn-danger" value="-" /></td>
		        					</tr>
		        				@endfor
		        			</tbody>
	        			</table><br>
                        <center>
        			        <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Agregar Fila</button>
        			        <button type="submit" class="btn btn-primary">Guardar</button>
                        </center>
        		</form>
        	</div>
            </div>
        	<div class="col-2">
        		<br>
        		<div class="dropdown">
				  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Niveles
				  		<span class="caret"></span>
				  	</button>
				  	<ul class="dropdown-menu">
				  		@foreach($niveles as $level)
				  			<li><a href="/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}">Nivel {{ $level->level }}</a></li>
				  		@endforeach
				  			<li><a href="/font/create/{{ $nivel->vigencia_id }}">Fuentes</a></li>
				  			<li><a href="/rubro/create/{{ $nivel->vigencia_id }}">Rubros</a></li>
				  			<li><a href="/level/create/{{ $nivel->vigencia_id }}">Nuevo Nivel</a></li>
				  	</ul>
				</div>
        	</div>
        </div>
    </div>


@stop

@section('js')
<script>
//funcion para boprrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#crud',
	created: function(id = {{ $nivel->id }}){
		this.getDatos(id);
	},
	data:{
		datos: []
	},
	methods:{
		getDatos: function(id){
			var urlVigencia = '/registro/'+id;
			axios.get(urlVigencia).then(response => {
				this.datos = response.data
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/registro/'+dato;
			axios.delete(urlVigencia).then(response => {
				this.getDatos();
				toastr.danger('Registro Eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		var nivel=parseInt($("#tabla tr").length);

			@if($nivel->level > 1)
	
				$('#tabla tr:last').after(' <tr><td><input type="hidden" name="register_id[]"><input type="text" class="form-control" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td><td><input type="text" class="form-control" name="nombre[]" required></td><td><select name="padre[]" class="form-control">@foreach($codes as $code)<option value="{{ $code->id }}">{{ $code->id }} - {{ $code->name }}</option>@endforeach</select></td><td><input type="button" class="borrar btn btn-danger" value="-" /></td></tr>');
			@else
				$('#tabla tr:last').after('<tr><td><input type="hidden" name="register_id[]"><input type="text" class="form-control" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td><td><input type="text" class="form-control" name="nombre[]" required></td><td></td><td><input type="button" class="borrar btn btn-danger" value="-" /></td></tr>');
			@endif
			
		}
	}
});
</script>
@stop