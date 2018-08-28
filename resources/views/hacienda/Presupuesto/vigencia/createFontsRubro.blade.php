@extends('layouts.dashboard')
@section('content')

<div id="content"> 
    <div id="contenido">
        <div class="row justify-content-center" id="crud">
        	<div class="col-3">
        		<div class="card">
        			<div class="card-title">
        				<center>
        					<h3>Fuentes y su disponibilidad</h3>
        				</center>
        			</div>
        			<div class="card-body">
        				<table class="table">
		        			<thead>
		        				<th>Fuente</th>
		        				<th>Disponibilidad</th>
		        			</thead>
		        			<tbody>
		        				@foreach($rubro->vigencia->fonts as $font)
		        				<tr>
		        					<td class="text-dark">{{ $font->name }}</td>
		        					<td class="text-dark">${{ $font->valor - $font->fontsRubro->sum('valor') }}</td>
		        				</tr>
		        				@endforeach
		        			</tbody>
		        		</table>
        			</div>
        		</div>
        	</div>
	        <div class="col-6">
	        		<div class="card">
	        			<div class="card-title">
	        				<center>
	        					<h3>Fuentes del rubro {{ $rubro->name }}</h3>
	        				</center>
	        			</div>
	        			<div class="card-body">
			        		<form action="{{url('/FontRubro')}}" method="POST">
			        				@csrf
				        			<input type="hidden" class="form-control"  name="rubro_id" value="{{ $rubro->id }}">
				        			<div class="table-responsive">
				        				<table class="table" id="tabla">
						        			<thead>
						        				<th class="text-center">Fuente</th>
						        				<th class="text-center">Valor</th>
						        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
						        			</thead>
						        			<tbody>
						        				@foreach($rubro->fontsRubro as $dato)
						        				<tr class="table-primary">
						        					@if($rubro->vigencia->fonts)
						        					<td>
						        						<input type="hidden" name="fontRubro_id[]" value="{{ $dato->id }}">
						        						<select name="font_id[]" class="form-control font">
						        							@foreach($rubro->vigencia->fonts as $font)
						        								<option value="{{ $font->id }}" @if($dato->font_id == $font->id) selected @endif>{{ $font->name }}</option>
						        							@endforeach
						        						</select>
						        					</td>
						        					@else
						        						<td>No existen fuentes en la Vigencia</td>
						        					@endif
						        					<td><input type="number" class="form-control" name="valor[]" value="{{ $dato->valor }}" required></td>
						        					<td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
						        				</tr>
						        				@endforeach
						        				<tr>
						        					@if($rubro->vigencia->fonts)
						        					<td>
						        						<input type="hidden" name="fontRubro_id[]">
						        						<select name="font_id[]" class="form-control">
						        							@foreach($rubro->vigencia->fonts as $font)
						        								<option value="{{ $font->id }}">{{ $font->name }}</option>
						        							@endforeach
						        						</select>
						        					</td>
						        					@else
						        						<td>No existen fuentes en la Vigencia</td>
						        					@endif
						        					<td><input type="number" class="form-control" name="valor[]" required></td>
						        					<td><button type="button" class="btn btn-danger borrar"> - </button></td>
						        				</tr>
						        			</tbody>
					        			</table>
					        		</div>
								<br>
								<center>
			        			<button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fila</button>
			        			<button type="submit" class="btn btn-primary">Guardar</button>
								</center>
								<br>
			        		</form>
			        	</div>
			        	<div class="card-footer">
			        		<center class="text-info">
			        			valor del rubro ${{ $rubro->fontsRubro->sum('valor') }}.00
			        		</center>
			        	</div>
			        </div>
	        </div>
	        <div class="col-1">
				<br>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Niveles
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							@foreach($rubro->vigencia->levels as $level)
								<li><a href="/registro/create/{{ $rubro->vigencia->id }}/{{ $level->level }}">Nivel {{ $level->level }}</a></li>
							@endforeach
								<li><a href="/font/create/{{ $rubro->vigencia->id  }}">Fuentes</a></li>
								<li><a href="/rubro/create/{{ $rubro->vigencia->id  }}">Rubros</a></li>
								<li><a href="/level/create/{{ $rubro->vigencia->id  }}">Nuevo Nivel</a></li>
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
		this.getDatosFont();
	},
	methods:{
		getDatosFont: function(){
			/*
			$('.font').each(function(){
			   alert($(this).val());
			});*/
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/FontRubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				location.reload();
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after('<tr>@if($rubro->vigencia->fonts) <td><input type="hidden" name="fontRubro_id[]"><select name="font_id[]" class="form-control"> @foreach($rubro->vigencia->fonts as $font) <option value="{{ $font->id }}">{{ $font->name }}</option> @endforeach </select></td> @else <td>No existen fuentes en la Vigencia</td> @endif <td><input type="number" class="form-control" name="valor[]" required></td><td><button type="button" class="btn btn-danger borrar"> - </button></td></tr>');
		}
	}
});
</script>
@stop