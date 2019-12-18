@extends('layouts.dashboard')
@section('titulo')
	Creación de Registros para el PUC
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
			<li><a href="/administrativo/contabilidad/puc/rubro/create/{{ $nivel->puc_id }}" class="btn btn-primary">Rubros</a></li>
			<li><a href="/administrativo/contabilidad/puc/level/create/{{ $nivel->puc_id }}" class="btn btn-primary">Niveles</a></li>
		</ul>
	</li>
@stop
@section('content')
	<div class="col-md-12 align-self-center" id="crud">
		<br><center><h2>Nivel {{ $nivel->level }} - {{ $nivel->name }}</h2></center><br>
			<form action="{{url('/administrativo/contabilidad/puc/registers')}}" method="POST"  class="form">
				{{ csrf_field() }}
				<input type="hidden"   name="level_id" value="{{ $nivel->id }}">
				<input type="hidden"   name="level" value="{{ $nivel->level }}">
				<table class="table table-bordered" id="tabla">
					<hr>
					<thead>
						@if($nivel->level > 1)
							<th class="text-center">Código</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Relación</th>
							<th></th>
						@else
							<th class="text-center">Código</th>
							<th class="text-center">Nombre</th>
							<th></th>
						@endif
					</thead>
					<tbody>
						<tr v-for="dato in datos">
							<th scope="row"><input type="hidden" name="register_id[]" v-model="dato.id"><input style="text-align:center" type="text" name="code[]" v-model="dato.code" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></th>
							<th scope="row"><input type="text" style="text-align:center" name="nombre[]" v-model="dato.name" required></th>
							@if($nivel->level > 1)
							<td>
								<select name="padre[]" class="form-control">
									@foreach($codes as $code)
										<option value="{{ $code->id }}" :selected="dato.register_puc_id == <?= $code->id; ?> ? true : false">{{ $code->code }} {{ $code->name }}</option>
									@endforeach
								</select>
							</td>
							@endif
							<td class="text-center"><button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
						</tr>
						@for ($i = 0; $i < $fila; $i++)
							<tr>
								<td><input type="hidden" name="register_id[]"><input type="text" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td>
								<td><input type="text"  name="nombre[]" required></td>
								@if($nivel->level > 1)
								<td>
								<select name="padre[]" class="form-control">
									@foreach($codes as $code)
										<option value="{{ $code->id }}">{{ $code->id }} - {{ $code->name }}</option>
									@endforeach
								</select>
								</td>
								@endif
								<td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td>
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
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#tabla').DataTable( {
			"paging":   false,
             responsive: true,
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
			var urlVigencia = '/administrativo/contabilidad/puc/registers/'+id;
			axios.get(urlVigencia).then(response => {
				this.datos = response.data
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/administrativo/contabilidad/puc/registers/'+dato;
			axios.delete(urlVigencia).then(response => {
				this.getDatos();
				toastr.success('Registro Eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		var nivel=parseInt($("#tabla tr").length);

			@if($nivel->level > 1)
	
				$('#tabla tr:last').after(' <tr><td><input type="hidden" name="register_id[]"><input type="text" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td><td><input type="text" name="nombre[]" required></td><td><select name="padre[]" class="form-control">@foreach($codes as $code)<option value="{{ $code->id }}" >{{ $code->id }} - {{ $code->name }}</option>@endforeach</select></td><td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td></tr>');
			@else
				$('#tabla tr:last').after('<tr><td><input type="hidden" name="register_id[]"><input type="text" name="code[]" pattern=".{<?= $nivel->cifras ?>,<?= $nivel->cifras ?>}" required title="solo se permiten <?= $nivel->cifras ?> cifras"></td><td><input type="text" name="nombre[]" required></td><td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td></tr>');
			@endif
			
		}
	}
});
</script>
@stop