@extends('layouts.dashboard')
@section('titulo')
    Creación de Rubros
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Niveles</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            @foreach($niveles as $level)
                <li><a href="/presupuesto/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
            @endforeach
            <li><a href="/presupuesto/font/create/{{ $vigencia_id }}" class="btn btn-primary">Fuentes</a></li>
            <li><a href="/presupuesto/rubro/create/{{ $vigencia_id }}" class="btn btn-primary">Rubros</a></li>
            <li><a href="/presupuesto/level/create/{{ $vigencia_id }}" class="btn btn-primary">Nuevo Nivel</a></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <h2><center>Creación de Rubros para la Vigencia {{ $vigencia->vigencia }}</center></h2><br>
            <hr>
        		<form action="{{ url('/presupuesto/rubro') }}" method="POST"  class="form">
                    {{ csrf_field() }}
	        			<input type="hidden" id="vigencia_id" name="vigencia_id" value="{{ $vigencia_id }}">
	        			<div class="table-responsive">
        				<table class="table table-bordered" id="tabla">
							<center>
                            </center><br>
		        			<thead>
		        				<th class="text-center">Registro</th>
		        				<th class="text-center">Sub Proyecto</th>
		        				<th class="text-center">Code</th>
		        				<th class="text-center">Nombre</th>
		        				<th class="text-center">Valor</th>
		        				<th class="text-center"><i class="fa fa-sign-in"></i></th>
		        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
		        			</thead>
		        			<tbody>
		        				@foreach($vigencia->rubros as $dato)
		        				<tr>
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
		        						<select name="subproyecto_id[]"  class="form-control">
		        							@foreach($subProy as $subProys)
		        								<option value="{{ $subProys->id }}" @if($dato->subproyecto_id ==  $subProys->id) selected @endif>{{ $subProys->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<th scope="row"><input type="text" style="text-align:center" name="code[]" value="{{ $dato->cod }}"></th>
		        					<th scope="row"><input type="text" style="text-align:center" name="nombre[]" value="{{ $dato->name }}"></th>
		        					<th scope="row" class="text-center" style="vertical-align:middle;">$ {{ $dato->fontsRubro->sum('valor')  }}</th>
		        					<td class="text-center" style="vertical-align:middle;"><a href="{{ url('/presupuesto/FontRubro', $dato->id) }}" class="btn-sm btn-success">&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</a></td>
		        					<td class="text-center" style="vertical-align:middle;"><button type="button" class="btn-sm btn-danger borrar" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
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
		        						<select name="subproyecto_id[]"  class="form-control">
		        							@foreach($subProy as $subProys)
		        								<option value="{{ $subProys->id }}">{{ $subProys->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<td><input type="hidden" name="rubro_id[]"><input type="text" name="code[]"></td>
		        					<td><input type="text" name="nombre[]"></td>
		        					<td></td>
		        					<td></td>
		        					<td style="vertical-align:middle;"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td>
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

    $(document).ready(function() {
        $('#tabla').DataTable( {
            responsive: true,
            "searching": false
        } );
    } );

//funcion para borrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#crud',

	methods:{

		eliminarDatos: function(dato){
			var urlVigencia = '/presupuesto/rubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				toastr.error('Rubro eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after("<tr><td><select name='register_id[]' class='form-control'>@foreach($registers as $register)<option value='{{ $register->id }}'>@foreach($codigos as $codigo)@if($codigo['id'] == $register->id) {{$codigo['codigo'] }} @endif @endforeach - {{ $register->name }}</option>@endforeach</select></td><td><select name='subproyecto_id[]'  class='form-control'>@foreach($subProy as $subProys)<option value='{{ $subProys->id }}'>{{ $subProys->name }}</option>@endforeach</select></td><td><input type='hidden' name='rubro_id[]'><input type='text' name='code[]'></td><td><input type='text' name='nombre[]'></td></td><td></td><td></td><td style='vertical-align:middle;' class='text-center'><input type='button' class='borrar btn-sm btn-danger' value='-'/></td></tr>");
		}
	}
});
</script>
@stop