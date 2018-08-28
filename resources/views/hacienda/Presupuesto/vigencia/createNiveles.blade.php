@extends('layouts.dashboard')
@section('titulo')
Creación de Niveles
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
                <li>
                    <a href="/presupuesto/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}" class="btn btn-primary">Nivel {{ $level->level }}</a>
                </li>
            @endforeach
            <li>
                <a href="{{ url('/presupuesto') }}" class="btn btn-primary">Fuentes</a>
            </li>
            <li>
                <a href="{{ url('/presupuesto') }}" class="btn btn-primary">Rubros</a>
            </li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Creación de Niveles para la Vigencia {{ $vigencia->vigencia }}</h2></center><br><br>
                        <form action="{{ url('/presupuesto/level') }}" method="POST"  class="form">
                            {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="vigencia_id" name="vigencia_id" value="{{ $vigencia->id }}">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla">
                                    <thead>
                                    <th class="text-center">Nivel</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Cifras</th>
                                    <th class="text-center">Filas</th>
                                    <th class="text-center"><i class="fa fa-trash-o"></i></th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="dato in datos" style="background-color:#9fcdff">
                                        <th scope="row"><input type="hidden" name="level_id[]" v-model="dato.id"><input type="text" style="text-align:center" name="nivel[]" v-model="dato.level"></th>
                                        <th scope="row"><input type="text" name="nombre[]" v-model="dato.name" style="text-align:center" required></th>
                                        <th scope="row"><input type="number" name="cifra[]" v-model="dato.cifras" style="text-align:center" required></th>
                                        <th scope="row"><input type="number" name="fila[]" v-model="dato.rows" style="text-align:center" required></th>
                                        <td class="text-center"><button type="button" v-on:click.prevent="eliminarDatos(dato.id)" class="btn-sm btn-danger" ><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                    @for($i=0;$i < $fila ;$i++)
                                        <tr>
                                            <td><input type="hidden" name="level_id[]"><input type="text" name="nivel[]"></td>
                                            <td><input type="text" name="nombre[]" required></td>
                                            <td><input type="number" name="cifra[]" required></td>
                                            <td><input type="number" name="fila[]"  required></td>
                                            <td class="text-center"><input type="button" value="-" class="btn-sm btn-danger borrar"/></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                                <br>
                            <center>
                                <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Agregar Fila</button>
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
	created: function(){
		this.getDatos();
	},
	data:{
		datos: []
	},
	methods:{
		getDatos: function(){
			var vigencia = $('#vigencia_id').val();
			var urlVigencia = '/presupuesto/level/'+vigencia;
			axios.get(urlVigencia).then(response => {
				this.datos = response.data;
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/presupuesto/level/'+dato;
			axios.delete(urlVigencia).then(response => {
				this.getDatos();
				toastr.success('Eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		var nivel=parseInt($("#tabla tr").length);
			$('#tabla tr:last').after('<tr><td><input type="hidden" name="level_id[]"><input type="text" name="nivel[]"></td><td><input type="text" name="nombre[]" required></td><td><input type="number" name="cifra[]" required></td><td><input type="number" name="fila[]" required></td><td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value="-" /></td></tr>');

		}
	}
});
</script>
@stop