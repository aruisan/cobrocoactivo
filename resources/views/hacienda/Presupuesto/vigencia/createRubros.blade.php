@extends('layouts.presupuesto')
@section('contenido')

	<div class="container-fluid" id="crud">
		<div class="row">
			<div class="col-12">
				<div class="card">
        		<form action="{{url('/rubro')}}" method="POST"  class="form">
        				@csrf
	        			<input type="hidden" class="form-control" id="vigencia_id" name="vigencia_id" value="{{ $vigencia->id }}">
	        			<div class="table-responsive">
        				<table class="table" id="tabla">
							<center>Creacion de Rubros para la Vigencia {{ $vigencia->vigencia }}</center><br>
							<center>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Niveles
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($niveles as $level)
                                        <li><a href="/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}">Nivel {{ $level->level }}</a></li>
                                    @endforeach
                                    <li><a href="/font/create/{{ $vigencia_id }}">Fuentes</a></li>
                                    <li><a href="/rubro/create/{{ $vigencia_id }}">Rubros</a></li>
                                    <li><a href="/level/create/{{ $vigencia_id }}">Nuevo Nivel</a></li>
                                </ul>
                            </div>
                            </center><br>
		        			<thead>
		        				<th class="text-center">Registro</th>
		        				<th class="text-center">Dependencia</th>
		        				<th class="text-center">Code</th>
		        				<th class="text-center">Nombre</th>
		        				<th class="text-center">Valor</th>
		        				<th class="text-center"><i class="fa fa-sign-in"></i></th>
		        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
		        			</thead>
		        			<tbody>
		        				@foreach($vigencia->rubros as $dato)
		        				<tr class="table-primary">
		        					<td>
		        						<input type="hidden" name="rubro_id[]" value="{{ $dato->id }}">
		        						<select name="register_id[]" class="form-control">
		        							@foreach($registers as $register)
		        								<option value="{{ $register->id }}" @if($dato->register_id == $register->id) selected @endif>
												@foreach($codigos as $codigo)
													@if($codigo['id'] == $register->id)
														{{$codigo['codigo'] }}
													@endif
												@endforeach	
		        								 - {{ $register->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<td>
		        						<select name="dependencia_id[]"  class="form-control">
		        							@foreach($dependencias as $dependencia)
		        								<option value="{{ $dependencia->id }}" @if($dato->dependencia_id ==  $dependencia->id) selected @endif>{{ $dependencia->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<td><input type="text" class="form-control" name="code[]" value="{{ $dato->cod }}"></td>
		        					<td><input type="text" class="form-control" name="nombre[]" value="{{ $dato->name }}"></td>
		        					<td class="text-dark">$ {{ $dato->fontsRubro->sum('valor')  }}</td>
		        					<td><a href="{{ url('/FontRubro', $dato->id) }}" class="btn btn-primary"><i class="fa fa-sign-in"></i></a></td>
		        					<td><button type="button" class="btn btn-danger borrar" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
		        				</tr>
		        				@endforeach
		        				@for($i=0;$i < $fila ;$i++)
								<tr>
		        					<td>
		        						<select name="register_id[]" class="form-control">
		        							@foreach($registers as $register)
		        								<option value="{{ $register->id }}">
												@foreach($codigos as $codigo)
													@if($codigo['id'] == $register->id)
														{{$codigo['codigo'] }}
													@endif
												@endforeach	
		        								 - {{ $register->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<td>
		        						<select name="dependencia_id[]"  class="form-control">
		        							@foreach($dependencias as $dependencia)
		        								<option value="{{ $dependencia->id }}">{{ $dependencia->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<td><input type="hidden" name="rubro_id[]"><input type="text" class="form-control" name="code[]"></td>
		        					<td><input type="text" class="form-control" name="nombre[]"></td>
		        					<td></td>
		        					<td></td>
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

	methods:{

		eliminarDatos: function(dato){
			var urlVigencia = '/rubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				toastr.error('Rubro eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after("<tr><td><select name='register_id[]' class='form-control'>@foreach($registers as $register)<option value='{{ $register->id }}'>@foreach($codigos as $codigo)@if($codigo['id'] == $register->id) {{$codigo['codigo'] }} @endif @endforeach - {{ $register->name }}</option>@endforeach</select></td><td><select name='dependencia_id[]'  class='form-control'>@foreach($dependencias as $dependencia)<option value='{{ $dependencia->id }}'>{{ $dependencia->name }}</option>@endforeach</select></td><td><input type='hidden' name='rubro_id[]'><input type='text' name='code[]' class='form-control'></td><td><input type='text' class='form-control' name='nombre[]'></td></td><td></td><td></td><td><input type='button' class='borrar btn btn-danger' value='-'/></td></tr>");
		}
	}
});
</script>
@stop