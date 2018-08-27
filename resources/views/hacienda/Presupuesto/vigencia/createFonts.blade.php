@extends('layouts.presupuesto')
@section('contenido')
<div id="content"> 
    <div id="inicio"></div>
    <div id="contenido">
        <div class="row justify-content-center" id="crud">
        	<div class="col-3">
        		<div class="card">
	        		<div class="card-title">
	        			<center>
	        				<center><h3>Estado Presupuestal de la Vigencia</h3></center>
	        			</center>
	        		</div>
	        		<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<tbody>
									<tr>
										<td>Presupuesto</td>
										<td class="text-dark">{{ $vigencia->presupuesto_inicial }}</td>
									</tr>
									<tr>
										<td>Ingresos en las Fuentes</td>
										<td class="text-dark">{{ $vigencia->fonts->sum('valor') }}</td>
									</tr>
									<tr>
										<td>Dinero Disponible</td>
										<td class="text-dark">{{ $vigencia->presupuesto_inicial - $vigencia->fonts->sum('valor') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
			        </div>
			    </div>
        	</div>
        	<div class="col-6">
        		<div class="card">
	        		<div class="card-title">
	        			<center>
	        				<center><h3>Creacion de Fuentes para la Vigencia {{ $vigencia->vigencia }}</h3></center>
	        			</center>
	        		</div>
	        		<div class="card-body">
			        	<form action="{{url('/font')}}" method="POST">
			        				@csrf
				        			<input type="hidden" class="form-control" id="vigencia_id" name="vigencia_id" value="{{ $vigencia->id }}">
				        			<div class="table-responsive">
				        				<table class="table" id="tabla">
						        			<thead>
						        				<th class="text-center">Code</th>
						        				<th class="text-center">Nombre</th>
						        				<th class="text-center">Valor</th>
						        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
						        			</thead>
						        			<tbody>
						        				<tr v-for="dato in datos" class="table-primary">
						        					<td><input type="hidden" class="form-control" name="font_id[]" v-model="dato.id"><input type="text" class="form-control" name="code[]" v-model="dato.code"></td>
						        					<td><input type="text" class="form-control" name="nombre[]" v-model="dato.name"></td>
						        					<td><input type="number" class="form-control" name="valor[]" v-model="dato.valor" required></td>
						        					<td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
						        				</tr>
						        				@for($i=0;$i < $fila ;$i++)
												<tr >
													<td><input type="hidden" class="form-control" name="font_id[]"><input type="text" class="form-control" name="code[]"></td>
						        					<td><input type="text" class="form-control" name="nombre[]" required></td>
						        					<td><input type="number" class="form-control" name="valor[]"  required></td>
						        					<td><input type="button" class="borrar btn btn-danger" value="-" /></td>
												</tr>
												@endfor
						        			</tbody>
					        			</table>
					        		</div><br><center>
			        		<button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fila</button>
			        		<button type="submit" class="btn btn-primary">Guardar</button>
							</center>
			        	</form>
			        </div>
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
						<li class="active">Fuentes</li>
						<li><a href="/rubro/create/{{ $vigencia->id }}">Rubros</a></li>
						<li><a href="/level/create/{{ $vigencia->id }}">Nuevo Nivel</a></li>
					</ul>
				</div>
			</div>
			</div>
        </div>
    </div>

@stop


@section('js')
<script>
	  	


//funcion para borrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#crud',
	created: function(){
		this.getDatos();
	},
	data:{
		datos: []
	},
	methods:{
		getDatos: function(){
			var urlVigencia = '/font/'+{{ $vigencia->id }};
			axios.get(urlVigencia).then(response => {
				this.datos = response.data;
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/font/'+dato;
			axios.delete(urlVigencia).then(response => {
				
					location.reload();
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after('<tr><td><input type="hidden" class="form-control" name="font_id[]"><input type="text" class="form-control" name="code[]"></td><td><input type="text" class="form-control" name="nombre[]" required></td><td><input type="number" class="form-control" name="valor[]" required></td><td><input type="button" class="borrar btn btn-danger" value="-" /></td></tr>');
		}
	}
});
</script>
@stop