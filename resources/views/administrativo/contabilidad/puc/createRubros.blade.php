@extends('layouts.dashboard')
@section('titulo')
    Creación de Rubros para el PUC
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/contabilidad/puc') }}" class="btn btn-success"><span class="hide-menu">PUC</span></a></li>
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Niveles</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            @foreach($niveles as $level)
				<li><a href="/administrativo/contabilidad/puc/registers/create/{{ $level->puc_id }}/{{$level->level}}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
            @endforeach
            <li><a href="/administrativo/contabilidad/puc/rubro/create/{{ $vigencia_id }}" class="btn btn-primary">Rubros</a></li>
			<li><a href="/administrativo/contabilidad/puc/level/create/{{ $level->puc_id }}" class="btn btn-primary">Niveles</a></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <h2><center>Creación de Rubros para el PUC</center></h2><br>
            <hr>
        		<form action="{{ url('/administrativo/contabilidad/puc/rubro') }}" method="POST"  class="form">
                    {{ csrf_field() }}
	        			<input type="hidden" id="vigencia_id" name="vigencia_id" value="{{ $vigencia_id }}">
	        			<div class="table-responsive">
        				<table class="table table-bordered" id="tabla">
							<center>
                            </center><br>
		        			<thead>
		        				<th class="text-center">Registro</th>
		        				<th class="text-center">Codigo</th>
		        				<th class="text-center">Nombre Cuenta</th>
		        				<th class="text-center">Codigo NIPS</th>
		        				<th class="text-center">Nombre NIPS</th>
		        				<th class="text-center">Naturaleza</th>
		        				<th class="text-center">Tercero</th>
		        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
		        			</thead>
		        			<tbody>
		        				@foreach($vigencia->rubros as $dato)
		        				<tr>
		        					<td>
		        						<input type="hidden" name="rubro_id[]" value="{{ $dato->id }}">
		        						<select name="register_id[]" class="form-control">
		        							@foreach($registers as $register)
		        								<option value="{{ $register->id }}" @if($dato->registers_puc_id == $register->id) selected @endif>
												@foreach($codigos as $codigo)
													@if($codigo['id'] == $register->id)
														{{$codigo['codigo'] }}
													@endif
												@endforeach
		        								 - {{ $register->name }}</option>
		        							@endforeach
		        						</select>
		        					</td>
		        					<th scope="row"><input type="number" style="text-align:center" maxlength="4" minlength="4" name="code[]" value="{{ $dato->codigo }}"></th>
		        					<th scope="row"><input type="text" style="text-align:center" name="nombre[]" value="{{ $dato->nombre_cuenta }}"></th>
		        					<th scope="row"><input type="number" style="text-align:center" name="codigoNIPS[]" value="{{ $dato->codigo_NIPS }}"></th>
		        					<th scope="row"><input type="text" style="text-align:center" name="nombreNIPS[]" value="{{ $dato->nombre_NIPS }}"></th>
		        					<th scope="row"><input type="number" style="text-align:center" name="naturaleza[]" value="{{ $dato->naturaleza}}"></th>
									<td scope="row">
										<select name="tercero_id[]" class="form-control">
											@foreach($terceros as $tercero)
												<option value="{{ $tercero->id }}" @if($dato->persona_id == $tercero->id) selected @endif>{{ $tercero->nombre }}</option>
											@endforeach
										</select>
									</td>
		        					<td class="text-center" style="vertical-align:middle;"><button type="button" class="btn-sm btn-danger borrar" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
		        				</tr>
		        				@endforeach
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
		        					<td><input type="hidden" name="rubro_id[]"><input type="text" pattern=".{4,4}" title="Recuerde que el codigo debe ser de 4 cifras" name="code[]" required></td>
		        					<td><input type="text" name="nombre[]" required></td>
		        					<td><input type="number" name="codigoNIPS[]"></td>
		        					<td><input type="text" name="nombreNIPS[]"></td>
		        					<td><input type="number" name="naturaleza[]" required></td>
		        					<td>
										<select name="tercero_id[]" class="form-control">
											@foreach($terceros as $tercero)
												<option value="{{ $tercero->id }}">{{ $tercero->nombre }}</option>
											@endforeach
										</select>
									</td>
									<td style="vertical-align:middle;"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td>
		        				</tr>
		        			</tbody>
	        			</table>
	        			</div><br><center>
        			<button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fila</button>
        			<button type="submit" class="btn btn-primary">Guardar</button>
					</center>
        		</form>
        	</div>
			</div>
@stop

@section('js')
<script>

    $(document).ready(function() {
        $('#tabla').DataTable( {
            responsive: true,
			ordering: false,
             "searching": false,
            "oLanguage": {
                "sZeroRecords": "", 
                "sEmptyTable": "",
                "sLoadingRecords"  : "Cargando...",
                "sSearch"     : "Buscar:",
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sUrl":            "",
                "sInfoThousands":  ",",

                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },

                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                
            }
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
			var urlVigencia = '/administrativo/contabilidad/puc/rubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				toastr.error('Rubro eliminado correctamente');
			});
		},

		nuevaFila: function(){

			$('#tabla tr:last').after("<tr>\n" +
					"        <td>\n" +
					"        <select name=\"register_id[]\" class=\"form-control\">\n" +
					"        @foreach($registers as $register)\n" +
					"        <option value=\"{{ $register->id }}\">\n" +
					"@foreach($codigos as $codigo)\n" +
					"@if($codigo['id'] == $register->id)\n" +
					"{{$codigo['codigo'] }}\n" +
					"@endif\n" +
					"@endforeach\n" +
					"         - {{ $register->name }}</option>\n" +
					"        @endforeach\n" +
					"        </select>\n" +
					"        </td>\n" +
					"        <td><input type=\"hidden\" name=\"rubro_id[]\"><input type=\"number\" name=\"code[]\" required></td>\n" +
					"        <td><input type=\"text\" name=\"nombre[]\" required></td>\n" +
					"        <td><input type=\"number\" name=\"codigoNIPS[]\"></td>\n" +
					"        <td><input type=\"text\" name=\"nombreNIPS[]\"></td>\n" +
					"        <td><input type=\"number\" name=\"naturaleza[]\" required></td>\n" +
					"        <td>\n" +
					"<select name=\"tercero_id[]\" class=\"form-control\">\n" +
					"@foreach($terceros as $tercero)\n" +
					"<option value=\"{{ $tercero->id }}\">{{ $tercero->nombre }}</option>\n" +
					"@endforeach\n" +
					"</select>\n" +
					"</td>\n" +
					"        <td style=\"vertical-align:middle;\"><input type=\"button\" class=\"borrar btn-sm btn-danger\" value=\"-\" /></td>\n" +
					"        </tr>");
		}
	}
});
</script>
@stop